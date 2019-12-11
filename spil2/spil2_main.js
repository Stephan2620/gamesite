const canvas = document.getElementById('tetris');

const context = canvas.getContext('2d');



context.scale(20, 20);


// fjener en raike hvis den er fyldt med 1'ere/brikker 
function arenaSweep() {

    let rowCount = 1;

    outer: for (let y = arena.length -1; y > 0; --y) {

        for (let x = 0; x < arena[y].length; ++x) {

            // hvis der er et 0 i raiken så den bare foresætte
            if (arena[y][x] === 0) {

                continue outer;

            }

        }



        const row = arena.splice(y, 1)[0].fill(0);

        arena.unshift(row);

        ++y;


        // giver playern 10 point per rowcount 
        player.score += rowCount * 10;
        // jo flere rows du får på sammen tid jo flere points får du så det bliver det ganget med 2 
        rowCount *= 2;

    }

}


// denne funktion skal finde ud af om vi kolidere med noget 
function collide(arena, player) {

    const m = player.matrix;

    const o = player.pos;

    for (let y = 0; y < m.length; ++y) {

        for (let x = 0; x < m[y].length; ++x) {

            if (m[y][x] !== 0 &&

               (arena[y + o.y] && 
                //  hvis det ikke er 0
                arena[y + o.y][x + o.x]) !== 0) {

                return true;

            }

        }

    }
    // hvis vi ikke kolidere
    return false;

}


// laver bruger overfladen fx. hvormange tiles i brede og højde 
function createMatrix(w, h) {

    const matrix = [];

    while (h--) {

        matrix.push(new Array(w).fill(0));

    }

    return matrix;

}


// de forskellige teris stykker og navne er 
function createPiece(type)

{

    if (type === 'I') {

        return [

            [0, 1, 0, 0],

            [0, 1, 0, 0],

            [0, 1, 0, 0],

            [0, 1, 0, 0],

        ];

    } else if (type === 'L') {

        return [

            [0, 2, 0],

            [0, 2, 0],

            [0, 2, 2],

        ];

    } else if (type === 'J') {

        return [

            [0, 3, 0],

            [0, 3, 0],

            [3, 3, 0],

        ];

    } else if (type === 'O') {

        return [

            [4, 4],

            [4, 4],

        ];

    } else if (type === 'Z') {

        return [

            [5, 5, 0],

            [0, 5, 5],

            [0, 0, 0],

        ];

    } else if (type === 'S') {

        return [

            [0, 6, 6],

            [6, 6, 0],

            [0, 0, 0],

        ];

    } else if (type === 'T') {

        return [

            [0, 7, 0],

            [7, 7, 7],

            [0, 0, 0],

        ];

    }

}


// giver alt andet end 0 en favrve 
function drawMatrix(matrix, offset) {

    matrix.forEach((row, y) => {

        row.forEach((value, x) => {

            if (value !== 0) {
                // så får brikkene lidt farver 
                context.fillStyle = colors[value];

                context.fillRect(x + offset.x,

                                 y + offset.y,

                                 1, 1);

            }

        });

    });

}


// giver baggunden farve som er sort i dette tilfælde 
// så 0 = sort 
function draw() {

    context.fillStyle = '#000';

    context.fillRect(0, 0, canvas.width, canvas.height);



    drawMatrix(arena, {x: 0, y: 0});

    drawMatrix(player.matrix, player.pos);

}


//  denne funktion fastgøre brikkerne altså kopier brikkerne og fast sætter dem i arena
function merge(arena, player) {

    player.matrix.forEach((row, y) => {

        row.forEach((value, x) => {

            if (value !== 0) {

                arena[y + player.pos.y][x + player.pos.x] = value;

            }

        });

    });

}


//  denne funktion gør at noget rotere dvs. at x og y bytter pladser
function rotate(matrix, dir) {

    for (let y = 0; y < matrix.length; ++y) {

        for (let x = 0; x < y; ++x) {

            [

                matrix[x][y],

                matrix[y][x],

            ] = [

                matrix[y][x],

                matrix[x][y],

            ];

        }

    }


    // bestemmer hvilken vej den skal dreje 
    if (dir > 0) {

        matrix.forEach(row => row.reverse());

    } else {

        matrix.reverse();

    }

}


// funktionen til at gå ned når man trykker på ned knappen  
function playerDrop() {

    player.pos.y++;
// og hvis man kolidere skal den bruge collide resætte fjenre en row og opdatere scoren
    if (collide(arena, player)) {

        player.pos.y--;

        merge(arena, player);

        playerReset();

        arenaSweep();

        updateScore();

    }

    dropCounter = 0;

}


// dette gør jeg for at man ikke kan gå ud over sidderne men at man godt kan gå vækfra siderne igen 
function playerMove(offset) {

    player.pos.x += offset;

    if (collide(arena, player)) {

        player.pos.x -= offset;

    }

}


// starte forfra funktion det er denne funktion der gør at det er en random der sponer 
function playerReset() {

    const pieces = 'TJLOSZI';

    player.matrix = createPiece(pieces[pieces.length * Math.random() | 0]);
    // man skal starte i toppen 
    player.pos.y = 0;
    // og man skal starte i midten altså havdelen a arena's længde
    player.pos.x = (arena[0].length / 2 | 0) -
                    // det skal og være midten af playern 
                   (player.matrix[0].length / 2 | 0);

// når den sponer en ny skal den tjekke om den kolidere og hvis den gør det så starter spillet forfra 
    if (collide(arena, player)) {

        arena.forEach(row => row.fill(0));

        player.score = 0;

        updateScore();

    }

}


// funktionen til at rotere
function playerRotate(dir) {

    const pos = player.pos.x;

    let offset = 1;

    rotate(player.matrix, dir);

// og den skal tjekke om man rammer væggen 
    while (collide(arena, player)) {

        player.pos.x += offset;

        offset = -(offset + (offset > 0 ? 1 : -1));

// og hvis man rammer væggen skal den skubbes ud fra væggen
        if (offset > player.matrix[0].length) {

            rotate(player.matrix, -dir);

            player.pos.x = pos;

            return;

        }

    }

}



let dropCounter = 0;

let dropInterval = 1000;



let lastTime = 0;
// laver en timer som skal bruge til at få playen til automatik at gå ned af 
function update(time = 0) {

    const deltaTime = time - lastTime;



    dropCounter += deltaTime;

    if (dropCounter > dropInterval) {
        // så hver gang det bliver 1000 mili sekunder 
        playerDrop();
        // laver den funktionen playerDrop
    }


    // og så resætter den timeren 
    lastTime = time;



    draw();
    // den gør at den tegner sig selv 
    requestAnimationFrame(update);

}


// insætter scoren i dukumentet
function updateScore() {

    document.getElementById('score').innerText = player.score;

}


// dette gør at brikken rykker sig ned hvis du trykker på ned klanppen 
document.addEventListener('keydown', event => {

    if (event.keyCode === 37) {
// til venstre
        playerMove(-1);

    } else if (event.keyCode === 39) {
// til højre
        playerMove(1);

    } else if (event.keyCode === 40) {
// ned knap
        playerDrop();

    } else if (event.keyCode === 81) {
// q for ar rotere
        playerRotate(-1);

    } else if (event.keyCode === 87) {
// w for ar rotere den anden vej
        playerRotate(1);

    } else if (event.keyCode === 38) {
// op knap fordi det kunne jeg bedre lide at spille med 
        playerRotate(1);

}

});



const colors = [

    null,

    '#FF0D72',

    '#0DC2FF',

    '#0DFF72',

    '#F538FF',

    '#FF8E0D',

    '#FFE138',

    '#3877FF',

];


//  konstatere hvor bred og høj som bliver sat ind i createMatrix funktionen 
const arena = createMatrix(12, 20);


// sætter start player i 0
const player = {

    pos: {x: 0, y: 0},

    matrix: null,

    score: 0,

};



playerReset();

updateScore();

update();