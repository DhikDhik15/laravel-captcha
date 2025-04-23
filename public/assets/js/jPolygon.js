/*
   jPolygon - a ligthweigth javascript library to draw polygons over HTML5 canvas images.
   Project URL: http://www.matteomattei.com/projects/jpolygon
   Author: Matteo Mattei <matteo.mattei@gmail.com>
   Version: 1.0
   License: MIT License
*/

var perimeter = new Array();
var complete = false;
var canvas = document.getElementById("sketch-form");
var ctx, x, y;

function point(x, y){
    ctx.lineWidth = 2;
    ctx.fillStyle= $('#sketch-color').val();
    ctx.strokeStyle = $('#sketch-color').val();
    ctx.fillRect(x-2,y-2,4,4);
    ctx.moveTo(x,y);
}

function undo(){
    ctx = undefined;
    perimeter.pop();
    complete = false;
    start(true);
}

function clear_canvas(){
    canvas = document.getElementById("sketch-form");
    ctx = undefined;
    perimeter = new Array();
    complete = false;
    document.getElementById('sketch-map').value = '';
    start();
}

function draw(end){

    ctx.lineWidth = 2;
    ctx.lineCap = "square";
    ctx.beginPath();

    if(perimeter.length > 0 ){
        for(var i=0; i<perimeter.length; i++){
            if(i==0){
                ctx.moveTo(perimeter[i]['x'],perimeter[i]['y']);
                end || point(perimeter[i]['x'],perimeter[i]['y']);
            } else {
                ctx.lineTo(perimeter[i]['x'],perimeter[i]['y']);
                end || point(perimeter[i]['x'],perimeter[i]['y']);
            }
        }
        if(end){
            ctx.lineTo(perimeter[0]['x'],perimeter[0]['y']);
            ctx.closePath();
            ctx.fillStyle = ctx.fillStyle = '#FFFFFF00';
            ctx.fill();
            ctx.strokeStyle = $('#sketch-color').val();
            complete = true;
        }
        ctx.stroke();

        // print sketch-map
        if(perimeter.length == 0){
            document.getElementById('sketch-map').value = '';
        } else {
            document.getElementById('sketch-map').value = JSON.stringify(perimeter);
        }
    }

}


function point_it(event) {
    if(complete){
        return !complete;
    }
    var rect, x, y;
    const falseReturn = false;

    rect = canvas.getBoundingClientRect();
    x = event.clientX - rect.left;
    y = event.clientY - rect.top;

    // prevent same point - double click
    if (perimeter.length>0 && x == perimeter[perimeter.length-1]['x'] && y == perimeter[perimeter.length-1]['y']){
        return falseReturn;
    }
    
    perimeter.push({'x':x,'y':y});
    draw(false);
    return falseReturn;
}

function start(with_draw) {
    var img = new Image();
    img.src = canvas.getAttribute('data-imgsrc');

    img.onload = function(){
        ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        if(with_draw == true){
            draw(false);
        }
    }
}

function sketchEditDraw(){
    perimeter = JSON.parse($('#sketch-map').val());
    canvas = document.getElementById("sketch-form");

    var img = new Image();
    img.src = canvas.getAttribute('data-imgsrc');
    img.onload = function(){

        ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        draw(true);
    }
}

function sketchDraw(map,color,type){
    var img = new Image();
    if(type == 'detail'){
        canvas = document.getElementById("sketch-detail");
        img.src = canvas.getAttribute('data-imgsrc-detail');
    }else if(type == 'view'){
        canvas = document.getElementById("sketch-view");
        img.src = canvas.getAttribute('data-imgsrc-view');
    }

    img.onload = function(){
        ctx = undefined;
        ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);

        if(map){
            perimeter =  JSON.parse(map);
            x = perimeter[0]['x'];
            y = perimeter[0]['y'];
                ctx.lineWidth = 2;
                ctx.lineCap = "square";
                ctx.beginPath();
                for(var i=0; i<perimeter.length; i++){
                    if(i==0){
                        ctx.moveTo(perimeter[i]['x'],perimeter[i]['y']);
                        point(perimeter[i]['x'],perimeter[i]['y']);
                    } else {
                        ctx.lineTo(perimeter[i]['x'],perimeter[i]['y']);
                        point(perimeter[i]['x'],perimeter[i]['y']);
                    }
                }
                ctx.lineTo(perimeter[0]['x'],perimeter[0]['y']);
                ctx.closePath();
                ctx.fillStyle = '#FFFFFF00';
                ctx.fill();
                ctx.strokeStyle = color;
                ctx.stroke();
        }
    }
}


function sketchFloorDraw(data){
    canvas = document.getElementById("sketch-floor");
    var img = new Image();
    img.src = canvas.getAttribute('data-imgsrc-sketch-floor');
    img.onload = function(){
        ctx = undefined;
        ctx = canvas.getContext("2d");
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        ctx.lineWidth = 2;
        ctx.lineCap = "square";
        let no = 1;
        $.each(data, function (key, val) {
            if(val.sketch_map){
                perimeter =  JSON.parse(val.sketch_map);
                x = perimeter[0]['x'];
                y = perimeter[0]['y'];

                ctx.beginPath();
                for(var i=0; i<perimeter.length; i++){
                    if(i==0){
                        ctx.moveTo(perimeter[i]['x'],perimeter[i]['y']);
                        point(perimeter[i]['x'],perimeter[i]['y']);
                    } else {
                        ctx.lineTo(perimeter[i]['x'],perimeter[i]['y']);
                        point(perimeter[i]['x'],perimeter[i]['y']);
                    }
                }
                ctx.lineTo(perimeter[0]['x'],perimeter[0]['y']);
                ctx.closePath();
                ctx.fillStyle = '#FFFFFF00';
                ctx.fill();
                ctx.strokeStyle = val.sketch_color;
                ctx.stroke();

                var newRow = $('<tr>');
                var cols = '';

                cols += '<td><label class="label">'+no+'</label></td>';
                cols += '<td><hr class="mb-3" style="border: none; height: 5px; background-color: '+val.sketch_color+' ; color: '+val.sketch_color+'"></td>';
                cols += '<td><label class="label">'+val.name+'</label></td>';

                // Insert the columns inside a row
                newRow.append(cols);

                // Insert the row inside a table
                $("#sketch-floor-table").append(newRow);
                no++
            }


        });
    }
}
