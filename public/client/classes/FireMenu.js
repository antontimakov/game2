/**
 * Класс меню команд огня
 */
class FireMenu {
    /**
     *
     */
    constructor() {

        const me = this;

        this.h = 50;

        /**
         * Ширина кнопок
         * @type {number}
         */
        this.btnW = 50;

        /**
         * Текещее положение курсора отрисовки кнопок
         * @type {number}
         */
        this.btnX = -this.btnW;

        this.background = {
            x: 0,
            y: Game.height - this.h,
            w: Game.width,
            h: this.h
        };

        this.btns = [
            {
                color: '#FF8000',
                click: ()=>{
                    Game.ball = new Fb1(250, 400);
                    me.goToSrv();
                }
            },
            {
                color: '#FF6000',
                click: ()=>{
                    Game.ball = new Fb2(250, 400);
                    me.goToSrv();
                }
            }
        ];

        // очерчиваем игровое поле
        Game.context.fillStyle = '#000000';
        Game.context.strokeRect(
            this.background.x,
            this.background.y,
            this.background.w,
            this.background.h
        );

        this.initButtons();
    }

    initButtons() {
        for (let btn of this.btns){
            Game.context.fillStyle = btn.color;
            Game.context.fillRect(
                this.btnX += this.btnW,
                this.background.y,
                this.btnW,
                this.h
            );

        }
    }

    goToSrv(){
        window.axios.get('http://192.168.1.103/')
            .then(response => {
                if (response.data){
                    const resp = response.data;

                    const damage = document.getElementById("damage");
                    const spanHpPlayer = document.getElementById("hpPlayer");
                    const spanHpEnemy = document.getElementById("hpEnemy");
                    const spanExpPlayer = document.getElementById("expPlayer");
                    const spanGoldPlayer = document.getElementById("goldPlayer");

                    damage.innerText = resp.damage;
                    spanHpPlayer.innerText = resp.hpPlayer;
                    spanHpEnemy.innerText = resp.hpEnemy;
                    spanExpPlayer.innerText = resp.expPlayer;
                    spanGoldPlayer.innerText = resp.goldPlayer;
                }
            })
            .catch(ee=>{console.log(ee);});
    }
}
