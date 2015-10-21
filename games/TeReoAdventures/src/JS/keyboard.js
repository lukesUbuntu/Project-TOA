$(function () {
    var $write = $('#write'),
        shift = false;
    capslock = false;

    $('#keyboardContainer button').click(function () {
        ///$("#keyboard").find("gameInput").click(function(){
        var $this = $(this),
            character = $this.text();

        /*//Shift Keys
         if ($this.hasClass('left-shift') || $this.hasClass('right-shift')) {
         $('.letter').toogleClass('uppercase');
         $('.symbol span').toggle();

         capslock = false;
         return false;
         }

         //Caps Lock
         if ($this.hasClass('capslock')) {
         $('.letter').toogleClass('uppercase');
         capslock = true;
         return false;
         }*/

        //Hint
        if ($this.hasClass('hint')) {
            console.log('hintWord', window.hintWord);
            character = '';
        }

        //Delete
        if ($this.hasClass('delete')) {
            var html = $write.val();
            $write.val(html.substr(0, html.length - 1));
            return false;
        }

        //Accept checks if current word typed into input box is correct with database word
        if ($this.hasClass('accept')) {
            console.log('winWord', window.winWord);
            character = '';

            if ($write.val() == window.winWord) {
                console.log("You guess correct!");

                $.getJSON('/api/addfeather?amount=4', function () {
                    console.log("You have earned this amount of feathers")
                })
            }
        }

        //Special characters
        if ($this.hasClass('symbol')) character = $('span:visible', $this).html();
        if ($this.hasClass('space')) character = ' ';
        if ($this.hasClass('tab')) character = '\t';

        //Uppercase letters
        if ($this.hasClass('uppercase')) character = character.toUpperCase();

        /*
         //Remove shift once a key is clicked
         if (shift === true) {
         $('.symbol.span').toggle();
         if (capslock === false) $('.letter').toggleClass('uppercase');
         shift = false;
         }*/
        console.log("DO IT", character);
        // Add the character
        $write.val($write.val() + character);
    });
});