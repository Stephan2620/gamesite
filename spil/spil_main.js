let canvas = document.querySelector("#canvas");
let ctx = canvas.getContext('2d');
let timeinterval;


let maze = [
    [-1,4,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,5,1],
    [0,0,0,1,0,0,1,0,0,1,0,0,0,0,0,0,0,0,0,4],
    [1,0,0,1,0,0,1,0,0,1,0,0,1,0,0,1,1,1,1,1],
    [1,0,0,0,0,0,0,0,0,1,0,0,1,0,0,0,0,0,1,1],
    [1,0,0,1,0,0,1,1,1,1,0,0,1,1,1,1,0,0,1,1],
    [1,0,0,1,0,0,0,0,0,0,0,0,0,0,0,1,0,0,1,1],
    [1,1,1,1,1,1,1,0,0,1,0,0,1,1,1,1,1,1,1,1],
    [1,0,0,0,0,0,1,4,0,1,0,0,1,0,0,1,0,0,0,1],
    [1,1,1,1,0,0,1,1,1,1,0,0,1,0,0,1,0,0,1,1],
    [1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1],
    [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,1,1],
    [1,0,0,0,0,0,1,0,0,1,0,0,0,0,0,1,0,0,0,1],
    [1,0,0,1,0,0,1,0,0,1,0,0,1,1,1,1,1,1,1,1],
    [1,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1],
    [1,0,1,1,0,0,4,1,1,1,0,1,1,1,1,1,1,1,0,1],
    [1,1,1,0,0,0,0,0,0,1,0,1,4,0,0,0,0,0,0,1],
    [1,6,1,1,0,0,1,1,1,1,0,1,0,0,4,1,1,1,1,1],
    [1,0,1,0,0,0,1,0,0,0,0,1,0,4,0,1,4,0,3,1],
    [1,0,0,0,1,0,1,0,0,1,0,1,0,0,0,0,0,0,4,1],
    [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1]
];
let x = 0;
let y = 0;
let player = -1;
let tileSize = 25;

let starttime = 0;
let endtime = 15;

let button = document.querySelector("#btn");
let bgsound = new Audio("spil/sound/tetris.mp3");
let gameover = new Audio("spil/sound/gameover.mp3");
let win = new Audio("spil/sound/win.mp3");
let falling = new Audio("spil/sound/falling.mp3");
button.addEventListener("click", buttonclicked);


let gras = new Image();
gras.src = 'spil/img/gras.jpg';

let sten = new Image();
sten.src = 'spil/img/sten.jpg';

let face = new Image();
face.src = 'spil/img/face.png';

let portal = new Image();
portal.src = 'spil/img/portal.png';




function buttonclicked(){
    bgsound.play();
    button.style.display = "none";

let timer = document.getElementById("timer")

document.querySelector("#timer").innerHTML = (endtime - starttime);

function timeIt(){
 starttime++


  document.querySelector("#timer").innerHTML = (endtime - starttime);


  if  (starttime == endtime) {
       starttime = 0;
       gameover.play();
       bgsound.pause();
       clearInterval(timeinterval);
       alert("NOOB")
       document.location.reload(true)

    }
}
timeinterval = setInterval(timeIt, 1000);

}




function grid() {

    for (y = 0; y < maze.length; y++) {

        for (x = 0; x < maze[y].length; x++) {

            if (maze[y][x] == -1) {
                player = { y, x }; // koordinater for player
                console.log(player.y + "  " + player.x);
                ctx.drawImage(face,x * tileSize, y * tileSize, tileSize, tileSize);
                // ctx.fillStyle = "red";
                // ctx.fillRect(x * tileSize, y * tileSize, tileSize, tileSize);
            }
            else if(maze[y][x] == 0){
                ctx.drawImage(gras,x * tileSize, y * tileSize, tileSize, tileSize);
                // ctx.fillStyle = "brown";
                // ctx.fillRect(x * tileSize, y * tileSize, tileSize, tileSize);
            }
            else if(maze[y][x] == 1){
                ctx.drawImage(sten,x * tileSize, y * tileSize, tileSize, tileSize);
                // ctx.fillStyle = "green";
                // ctx.fillRect(x * tileSize, y * tileSize, tileSize, tileSize);
            }   else if(maze[y][x] == 3){
                ctx.fillStyle = "gold";
                ctx.fillRect(x * tileSize, y * tileSize, tileSize, tileSize);
            }
            else if(maze[y][x] == 4){
                ctx.fillStyle = "black";
                ctx.fillRect(x * tileSize, y * tileSize, tileSize, tileSize);
            }
            else if(maze[y][x] == 5){
                ctx.drawImage(portal,x * tileSize, y * tileSize, tileSize, tileSize);
            }
            else if(maze[y][x] == 6){
                ctx.drawImage(portal,x * tileSize, y * tileSize, tileSize, tileSize);
            }
        }
    }

}

window.addEventListener('keydown', keycode)




function keycode(){

    switch (event.keyCode) {
         case 39: // højre
         
            if (maze[player.y][player.x + 1] == 0) {

                maze[player.y][player.x + 1] = -1; //players nye position
                maze[player.y][player.x] = 0; // player gamle position

            }
            else if(maze[player.y][player.x + 1] == 4) {
                falling.play();
                clearInterval(timeinterval);
                bgsound.pause();
                alert("U DEAD NIBBER")
                document.location.reload(true)
            }
            else if(maze[player.y][player.x + 1] == 3) {
                win.play();
                clearInterval(timeinterval);
                bgsound.pause();
                alert("U WIN")
            }

                grid();
         break

         case 40:// down key
         

            if (maze[player.y + 1][player.x] == 0) {

                maze[player.y + 1][player.x] = -1; //players nye position
                maze[player.y][player.x] = 0; // player gamle position

            }           
             else if(maze[player.y + 1][player.x] == 4) {
                falling.play();
                clearInterval(timeinterval);
                bgsound.pause();
                alert("U DEAD NIBBER")
                document.location.reload(true)
            }
            else if(maze[player.y + 1][player.x] == 3) {
                win.play();
                clearInterval(timeinterval);
                bgsound.pause();
                alert("U WIN")
            }
                grid();
         break;

         case 37: //venstre
         
            if (maze[player.y][player.x - 1] == 0) {

                maze[player.y][player.x - 1] = -1; //players nye position
                maze[player.y][player.x] = 0; // player gamle position

            }
            else if(maze[player.y][player.x - 1] == 4) {
                falling.play();
                clearInterval(timeinterval);
                bgsound.pause();
                alert("U DEAD NIBBER")
                document.location.reload(true)
            }
            else if(maze[player.y][player.x - 1] == 3) {
                win.play();
                clearInterval(timeinterval);
                bgsound.pause();
                alert("U WIN")
            }


                grid();

         break;

            case 38: //KeyUp
                if (maze[player.y - 1][player.x] == 0) {

    
                    maze[player.y - 1][player.x] = -1; //players nye position
                    maze[player.y][player.x] = 0; // player gamle position
    
                }
                else if(maze[player.y - 1][player.x] == 3) {
                    win.play();
                    clearInterval(timeinterval);
                    bgsound.pause();
                    alert("U WIN")
                }
                else if(maze[player.y - 1][player.x] == 5) {
                    maze[player.y + 16][player.x-17] = -1;
                    maze[player.y][player.x] = 0;
                }
                else if(maze[player.y - 1][player.x] == 6) {
                    maze[player.y - 16][player.x+17] = -1;
                    maze[player.y][player.x] = 0;
                }
                else if(maze[player.y - 1][player.x] == 4) {
                    falling.play();
                    clearInterval(timeinterval);
                    bgsound.pause();
                    alert("U DEAD NIBBER")
                    document.location.reload(true)
                }
                    grid();
    
    
                break;
    
            default:
                break;
        }
    }
    grid();





window.addEventListener("load",grid);










    

// gamle bane 
// [1,1,1,0,0,0,1,1,1,3],
// [6,1,0,0,1,0,1,0,0,0],
// [0,1,1,0,1,4,1,0,1,0],
// [0,1,1,0,1,1,1,0,1,0],
// [0,0,0,0,1,0,0,0,1,1],
// [1,1,1,0,1,0,1,1,1,1],
// [1,4,1,0,4,0,1,5,1,0],
// [0,0,1,0,0,0,1,0,1,0],
// [0,1,1,1,1,1,1,0,0,1],
// [-1,0,0,0,0,0,0,0,0,4]