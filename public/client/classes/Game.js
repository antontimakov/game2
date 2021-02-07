/**
 * Класс определяющий параметры игрового поля
 */
class Game
{
    static init()
    {
        /**
         * Канвас объект
         * @type {HTMLElement}
         */
        this.canvas = document.getElementById("fishingPlay");

        /**
         * Ширина поля
         * @type {number}
         */
        this.width = 745;

        /**
         * Высота поля
         * @type {number}
         */
        this.height = 500;

        /**
         * Частота обновления кадров
         * @type {number}
         */
        this.timeout = 1000 / 50;

        /**
         * Контекст объект канваса
         * @type {OffscreenRenderingContext|CanvasRenderingContext2D|WebGLRenderingContext}
         */
        this.context = this.create();

        // очерчиваем игровое поле
        Game.context.fillStyle = '#000000';
        Game.context.strokeRect(
            0,
            0,
            this.width,
            this.height
        );

        this.pusherConnect();
        //Game.menu = new FireMenu();


        /*this.canvas.onmousemove = function (poE){
            Game.over(poE)
        };*/

        setInterval(this.renderFrame, this.timeout);

        // настройки текста
        Game.context.font = 'bold 20px courier';
        Game.context.textAlign = 'left';
        Game.context.textBaseline = 'top';
        Game.context.fillStyle = 'black';

        //Game.goToSrv();
    }

    static over(poE){
        const menuBgr = Game.menu.background;
        if (Game.overMy(poE, menuBgr)){
            Game.canvas.style.cursor = 'pointer';
            // номер кнопки
            const numBut = Math.floor(poE.pageX / Game.menu.btnW);
            const curBtn = Game.menu.btns[numBut];
            if (curBtn){
                this.canvas.onclick = curBtn.click;
            }
            // if (this.clickBody){
            //     Game.canvas.style.cursor = 'pointer';
            // }
            // if (this.overBody){
            //     this.overBody(poE);
            // }
        }
    }

    static overMy(poE, menuBgr){
        return (
            poE.pageX > menuBgr.x &&
            poE.pageX <= (menuBgr.x + menuBgr.w) &&
            poE.pageY > menuBgr.y &&
            poE.pageY <= (menuBgr.y + menuBgr.h)
        );
    }

    /**
     * Создаёт поле
     * @returns {OffscreenRenderingContext | CanvasRenderingContext2D | WebGLRenderingContext}
     */
    static create(){
        this.canvas.width = this.width;
        this.canvas.height = this.height;
        return this.canvas.getContext("2d");
    }

    /**
     * Отрисовка кадра
     */
    static renderFrame()
    {
        // Если анимация закончена
        if (Game.ball && Game.ball.animate() === true){
            Game.ball = null;
            Game.goToSrv('battle')
        }
    }

    /**
     * Соединение по веб сокету
     */
    static pusherConnect()
    {
        // TODO delete me
        //Pusher.logToConsole = true;

        const pusher = new Pusher('82314a91fbaa0b80b82e', {
            cluster: 'mt1'
        });

        const channel = pusher.subscribe('my-channel');
        channel.bind('my-event', function(data) {

            const msg = document.getElementById("msg");
            if (data.message.msg){
                msg.innerText = data.message.msg;
            }

            /*// Отрисовка заднего фона
            Game.context.fillStyle = '#FFFFFF';
            Game.context.fillRect(
                0,
                Game.height - 20,
                200,
                20
            );
            // Текс с сервера
            Game.context.fillStyle = 'black';
            Game.context.fillText(
                data.message,
                0,
                Game.height - 20
            );*/
        });
    }

    static goToSrv(path = ''){
        window.axios.get('http://192.168.1.103/' + path)
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
