/**
 * Obet Jongle
 * Mini-jeux de qui consiste a faie le maximum de jongle en 1mn
 */
function Jongle(){
	this.ball = document.getElementById('ballon');
	this.pointElt = document.querySelector('.point_count');
	this.minuteElt = document.querySelector('.minute');
	this.secondeElt = document.querySelector('.seconde');
	this.replayElt = document.querySelector('.replay');

	this.inPlay = false;
	this.departPosition = 0;
	this.ballPosition = 0;
	this.destination = this.ballPosition - 270;
	this.direction = 1; 
	this.speed = 3;
	this.needToStop = false;

	/**
	 * lance les fonction a l'ouverture de la page
	 */
	this.init = function(){
		//this.createGame();
		this.ball.addEventListener('click', this.onClickBallon.bind(this));	
		this.moveBall = this.moveBall.bind(this);
		this.replayElt.addEventListener('click', this.newGame.bind(this));
	}

	/**
	 * Cree un element avec une class
	 */
	this.createElementWithClass = function(elt, className){
		var element = document.createElement(elt);
		element.setAttribute("class", className);
		return element;
	}

	/**
	 * Cree les element du jeux
	 */
	 /*
	this.createGame = function(){
		this.divHeaderGameElt = this.createElementWithClass("div", "header_game");
		this.divGameElt = this.createElementWithClass("div", "game");

		params.container.appendChild(this.divHeaderGameElt);
		params.container.appendChild(this.divGameElt);

		this.divTimerElt = this.createElementWithClass("div", "timer");
		this.divPointElt = this.createElementWithClass("div", "point");

		this.divHeaderGameElt.appendChild(this.divTimerElt);
		this.divHeaderGameElt.appendChild(this.divPointElt);

		this.firstParaTimerElt = document.createElement("p");
		this.firstParaTimerElt.textContent = "Temps restant :"
		this.secondParaTimerElt = this.createElementWithClass("p", "number_game");

		this.firstParaTimerElt.appendChild(divTimerElt);
		this.secondParaTimerElt.appendChild(divTimerElt);
	}*/

	/**
	 * Apelle les fonction a executer lors du click sur le ballon
	 */
	this.onClickBallon = function(event){
		if (!this.inPlay) {
			this.inPlay = true;
			this.countDown();
			this.moveBall();
			this.pointPlus();
		} else if (this.ballPosition >= 0 && this.ballPosition <= 170){
			this.stopAnimation();
			this.needToStop = true;
			this.moveBall();
			this.pointPlus();
		}
	}

	/**
	 * Definie la trajectoire du ballon avec une animation
	 */
	this.moveBall = function(){
		if (this.ballPosition === this.destination) {
			this.direction = -1;
		}

		this.ballPosition += - this.speed * this.direction;
		this.ball.style.transform = 'translateY(' + this.ballPosition + 'px)';
		this.requestId = requestAnimationFrame(this.moveBall);
		this.gameOver();

		if(this.needToStop){
			this.stopAnimation();
			this.direction = 1;
			this.needToStop = false;
			this.requestId = requestAnimationFrame(this.moveBall);
		}
	}

	/**
	 * Rajoute un point au compteur
	 */
	this.pointPlus = function(){
		if (this.inPlay) 
			this.pointElt.textContent ++;
	}

	/**
	 * Arrete l'animation et le compte a rebours 
	 */
	this.stopGame = function(){
		this.stopAnimation();
		clearInterval(this.intervalId);
		this.inPlay = false;
		this.needToStop = false;
		this.replayElt.classList.remove('hidden');
	}

	/**
	 * Relance le jeu a zero 
	 */
	this.newGame = function(){
		this.ballPosition = 0;
		this.direction = 1;
		this.ball.style.transform = 'translateY(0px)';
		this.pointElt.textContent = '0';
		this.minuteElt.textContent = '1';
		this.secondeElt.textContent = '00';
		this.replayElt.classList.add('hidden');
	}

	/**
	 * Arrete l'animation  
	 */
	this.stopAnimation = function(){
		cancelAnimationFrame(this.requestId);
	}

	/**
	 * Si le ballon touche le sol 
	 */
	this.gameOver = function(){
		if (this.ballPosition >= 90){
			this.stopGame();
		}
	}

	/**
	 * Compte a Rebours de 1mn
	 */
	this.countDown = function(){
		var ctx = this;
		var	finishDate = new Date().getTime() + 60000;
		this.intervalId = setInterval(function() {	//	lance la function a execter toute les secondes
		    var now = new Date().getTime();	
		    var diff = Math.floor( (finishDate - now) / 1000);
		    if(diff >= 0){	//	s'affiche jusaqu a 0
		        var minutes = Math.floor(diff % 3600/60);
		        var seconds = Math.floor(diff % 60);
		        if (seconds < 10) {
		            seconds = ("0" + seconds);
		        }
		        ctx.minuteElt.textContent = minutes;  
		        ctx.secondeElt.textContent = seconds;  
		    } else { //s'arrete a 0
		    	ctx.stopGame();
		    }           
		},1000); 
	}

	this.init();
}

//var divContainerElt = document.querySelector('.container_game');
var game = new Jongle();