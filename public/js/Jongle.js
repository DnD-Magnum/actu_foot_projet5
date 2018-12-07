/**
 * Obet Jongle
 * Mini-jeux de qui consiste a faie le maximum de jongle en 1mn
 */
function Jongle(){
	this.ball = document.getElementById('ballon');
	this.pointElt = document.querySelector('.point_count');
	this.minuteElt = document.querySelector('.minute');
	this.secondeElt = document.querySelector('.seconde');

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
		this.ball.addEventListener('click', this.onClickBallon.bind(this));	
		this.moveBall = this.moveBall.bind(this);
	}

	/**
	 * Apelle les fonction a executer lors du click sur le ballon
	 */
	this.onClickBallon = function(event){
		this.stopAnimation();
		if (!this.inPlay) {
			this.inPlay = true;
			this.countDown();
		}else {
			this.needToStop = true;
		}
		this.moveBall();
		this.pointPlus();
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

	/*this.moveBallDown = function(){
		this.ballPosition = 90;
		this.ball.style.transform = 'translateY(' + this.ballPosition + 'px)';
	}*/

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
	}

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

var game = new Jongle();



/*
var ball = document.getElementById('ballon');
var pointElt = document.querySelector('.point_count');
var minuteElt = document.querySelector('.minute');
var secondeElt = document.querySelector('.seconde');

var inPlay = false;
var ballPosition = 0;
var destination = ballPosition + -250;
var direction = 1; 
var speed = 2;

var requestId;
var intervalId;

function moveBall(){
	if (ballPosition === destination) {
			direction = -1;
	}
	ballPosition += - speed * direction;
	ball.style.transform = 'translateY(' + ballPosition + 'px)';
	requestId = requestAnimationFrame(moveBall);
	gameOver();
}

function stopAnimation(){
	cancelAnimationFrame(requestId);
	clearInterval(intervalId);
	inPlay = false;
}

function gameOver(){
	if (ballPosition >= 10){ //gameOver
		stopAnimation();
	}
}

function onClickBallon(event){
	if (!inPlay) {
		countDown();
		inPlay = true;
	}
	moveBall();
	pointPlus();
	event.preventDefault();
	//console.log(1200000 / 20);
}

function pointPlus(){
	pointElt.textContent ++;
}

function countDown(){
	var	finishDate = new Date().getTime() + 60000;
	intervalId = setInterval(function() {	//	lance la function a execter toute les secondes
	    var now = new Date().getTime();	
	    var diff = Math.floor( (finishDate - now) / 1000);
	    if(diff >= 0){	//	s'affiche jusaqu a 0
	        var minutes = Math.floor(diff % 3600/60);
	        var seconds = Math.floor(diff % 60);
	        if (seconds < 10) {
	            seconds = ("0" + seconds);
	        }
	        minuteElt.textContent = minutes;  
	        secondeElt.textContent = seconds;  
	    } else { //s'arrete a 0
	    	stopAnimation();
	    }           
	},1000); 
}

ball.addEventListener('click', onClickBallon);*/