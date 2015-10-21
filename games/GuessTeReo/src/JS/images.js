// Image factory
var createImage = function(src) {
    var img   = new Image();
    img.src   = src;
    return img;
};

// array of images
var images = [];

images.push(createImage());

imgArray[0] = new Image("../../assets/img/01.jpg");
imgArray[0] = new Image("../../assets/img/02.jpg");
imgArray[0] = new Image("../../assets/img/03.jpg");
imgArray[0] = new Image("../../assets/img/04.jpg");
imgArray[0] = new Image("../../assets/img/05.jpg");
imgArray[0] = new Image("../../assets/img/06.jpg");
imgArray[0] = new Image("../../assets/img/07.jpg");
imgArray[0] = new Image("../../assets/img/08.jpg");
imgArray[0] = new Image("../../assets/img/09.jpg");
imgArray[0] = new Image("../../assets/img/10.jpg");
imgArray[0] = new Image("../../assets/img/11.jpg");
imgArray[0] = new Image("../../assets/img/12.jpg");
imgArray[0] = new Image("../../assets/img/13.jpg");
imgArray[0] = new Image("../../assets/img/14.jpg");
imgArray[0] = new Image("../../assets/img/15.jpg");
imgArray[0] = new Image("../../assets/img/16.jpg");
imgArray[0] = new Image("../../assets/img/17.jpg");
imgArray[0] = new Image("../../assets/img/18.jpg");
imgArray[0] = new Image("../../assets/img/19.jpg");
imgArray[0] = new Image("../../assets/img/20.jpg");
imgArray[0] = new Image("../../assets/img/21.jpg");
imgArray[0] = new Image("../../assets/img/22.jpg");
imgArray[0] = new Image("../../assets/img/23.jpg");
imgArray[0] = new Image("../../assets/img/24.jpg");
imgArray[0] = new Image("../../assets/img/25.jpg");
imgArray[0] = new Image("../../assets/img/26.jpg");
imgArray[0] = new Image("../../assets/img/27.jpg");
imgArray[0] = new Image("../../assets/img/28.jpg");
imgArray[0] = new Image("../../assets/img/29.jpg");
imgArray[0] = new Image("../../assets/img/30.jpg");
imgArray[0] = new Image("../../assets/img/31.jpg");
imgArray[0] = new Image("../../assets/img/32.jpg");
imgArray[0] = new Image("../../assets/img/33.jpg");
imgArray[0] = new Image("../../assets/img/34.jpg");
imgArray[0] = new Image("../../assets/img/35.jpg");
imgArray[0] = new Image("../../assets/img/36.jpg");
imgArray[0] = new Image("../../assets/img/37.jpg");
imgArray[0] = new Image("../../assets/img/38.jpg");
imgArray[0] = new Image("../../assets/img/39.jpg");
imgArray[0] = new Image("../../assets/img/40.jpg");
imgArray[0] = new Image("../../assets/img/41.jpg");
imgArray[0] = new Image("../../assets/img/42.jpg");
imgArray[0] = new Image("../../assets/img/43.jpg");
imgArray[0] = new Image("../../assets/img/44.jpg");
imgArray[0] = new Image("../../assets/img/45.jpg");
imgArray[0] = new Image("../../assets/img/46.jpg");
imgArray[0] = new Image("../../assets/img/47.jpg");
imgArray[0] = new Image("../../assets/img/48.jpg");
imgArray[0] = new Image("../../assets/img/49.jpg");
imgArray[0] = new Image("../../assets/img/50.jpg");

function nextImage(element)
{
    var img = document.getElementById(element);

    for(var i = 0; i < imgArray.length;i++)
    {
        if(imgArray[i].src == img.src) // << check this
        {
            if(i === imgArray.length){
                document.getElementById(element).src = imgArray[0].src;
                break;
            }
            document.getElementById(element).src = imgArray[i+1].src;
            break;
        }
    }
}
