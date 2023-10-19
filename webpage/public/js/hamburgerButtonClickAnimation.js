let onOff = 0;

function setOnOff(num) {
    console.log(num);
    onOff = num;
}

function getOnOff() {
    return onOff;
}

function myFunction(x) {
    console.log("This works");
    x.classList.toggle("change");
    if (getOnOff() == 0) {
        document.getElementById('menu').classList.add('show');
        setOnOff(1);
    } else {
        document.getElementById('menu').classList.remove('show');
        setOnOff(0);
    }
}