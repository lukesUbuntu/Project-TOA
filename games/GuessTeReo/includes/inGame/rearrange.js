function load() {
    var array = [];

    while (array.length < 10) {
        var temp = Math.round(Math.random() * 9);
        if (!contain(array, temp)) {
            array.push(temp);
        }
    }
    for (i = 0; i < 10; i++) {
        var btn = document.getElementById("btn" + i);
        btn.value = array[i];
    }
}