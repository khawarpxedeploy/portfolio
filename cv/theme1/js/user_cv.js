"use strict";

/*----------------------------
       	SetColor Active
    ------------------------------*/
var hexDigits = new Array("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f"); 

function rgb2hex(rgb) {
    rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    return "#" + hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
}
function hex(x) {
    return isNaN(x) ? "00" : hexDigits[(x - x % 16) / 16] + hexDigits[x % 16];
}


let sidebar = document.querySelector('.sidebar')
let layout = document.querySelector('.layout')
setColor(sidebar)
setColor(layout)

function setColor(layout){
    let childs = layout.querySelectorAll("*")
    let color  = layout.style.backgroundColor;
    let contrast = getContrastColor(rgb2hex(color));
    childs.forEach(child => {
        child.style.color = contrast;
    });
}

function getContrastColor(value) {
    const hexCode = value.charAt(0) === '#' 
              ? value.substr(1, 6)
              : value;

    const hexR = parseInt(hexCode.substr(0, 2), 16);
    const hexG = parseInt(hexCode.substr(2, 2), 16);
    const hexB = parseInt(hexCode.substr(4, 2), 16);
    // Gets the average value of the colors
    const contrastRatio = (hexR + hexG + hexB) / (255 * 3);

    return contrastRatio >= 0.5 ? 'black' : 'white';
}

