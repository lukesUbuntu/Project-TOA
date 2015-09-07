// Game class

Game = function()
{
    this.posX = 0;
    this.posY = 0;
    this.velX = 100;
    this.velY = 100;
    this.sizeX = 80;
    this.sizeY = 40;
    this.gravityY = 900;
    this.paused = false;
    this.images = {};
    this.InGameMenu = null;
};

Game.prototype.Tick = function(elapsed)
{
    fps.update(elapsed);
    this.Logic(elapsed);
    this.Render(elapsed);
};

Game.prototype.Logic = function(elapsed)
{
    // --- Input

    InputManager.padUpdate();

    // --- Logic

    if (InputManager.padPressed & InputManager.PAD.CANCEL) {
        this.paused = true;
        this.StartInGameMenu();
    }

    if (!this.paused)
    {
        if ((InputManager.padPressed & InputManager.PAD.OK) && this.velY >= -10)
        {
            AudioManager.play("jump");
            this.velY = -1000;
        }

        // Movement physics
        this.posX += this.velX*elapsed;
        this.posY += (this.velY + 0.5*this.gravityY*elapsed)*elapsed;
        this.velY += this.gravityY*elapsed;
        // Collision detection and response
        var bouncedX = false, bouncedY = false;
        if ( (this.posX <= 0 && this.velX < 0) || (this.posX >= canvas.width-this.sizeX && this.velX > 0) )
        {
            this.velX = -this.velX;
            bouncedX = true;
        }
        if ( (this.posY <= 0 && this.velY < 0) || (this.posY >= canvas.height-this.sizeY && this.velY > 0) )
        {
            this.velY = -this.velY*0.7;
            bouncedY = true;
        }
        if (bouncedX)
            AudioManager.play("ping");
        if (bouncedY)
            AudioManager.play("bounce");
    }
};

Game.prototype.Render = function(elapsed)
{
    // Clear the screen
    var grad = ctx.createLinearGradient(0, 0, 0, canvas.height);
    grad.addColorStop(0, '#06B');
    grad.addColorStop(0.9, '#fff');
    grad.addColorStop(0.9, '#3C0');
    grad.addColorStop(1, '#fff');
    ctx.fillStyle = grad;
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    // Render objects
    ctx.drawImage(this.images['sun'], 600, 20);

    ctx.strokeRect(this.posX, this.posY, this.sizeX, this.sizeY);
    ctx.textAlign = "center";
    ctx.fillStyle = "red";
    ctx.font = "10px sans-serif";
    ctx.fillText("Hello World!", this.posX+this.sizeX/2, this.posY+25);
    // Paused / Unpaused text
    //ctx.textAlign = "center";
    //ctx.fillStyle = "white";
    //ctx.font = "22px sans-serif";
    //ctx.fillText(this.paused? "Paused" : "Running", canvas.width/2, 25);
};


Game.prototype.StartInGameMenu = function()
{
    InputManager.reset();
    var bindThis = this;
    this.InGameMenu = new Menu("In-game Menu",
        [ "Continue", "Quit" ],
        "",
        70, 50, 400,
        function(numItem) {
            if (numItem == 0) { GameLoopManager.run(function(elapsed) { bindThis.Tick(elapsed); }); bindThis.paused = false; bindThis.InGameMenu = null;  }
            else if (numItem == 1) StartMainMenu();
        },
        function(elapsed) { bindThis.Render(elapsed); });
    GameLoopManager.run(function(elapsed) { bindThis.InGameMenu.Tick(elapsed); });
};