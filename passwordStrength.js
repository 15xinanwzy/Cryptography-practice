function PasswordStrength(passwordID,strengthID){
 this.init(strengthID);
 var _this = this;
 document.getElementById(passwordID).onkeyup = function(){
 _this.checkStrength(this.value);
 }
};
PasswordStrength.prototype.init = function(strengthID){
 var id = document.getElementById(strengthID);
 var p = document.createElement('p');
 var strong = document.createElement('strong');
 this.oStrength = id.appendChild(p);
 this.oStrengthTxt = id.parentNode.appendChild(strong);
};
PasswordStrength.prototype.checkStrength = function (val,check){
 var aLvTxt = ['','弱','中','强'];
 var lv = 0;
 if(val.match(/[a-z]/g)){lv++;}
 if(val.match(/[0-9]/g)){lv++;}
 if(val.match(/[A-Z]/g)){lv++;}
 if(val.match(/(.[^a-zA-Z0-9])/g)){lv++;}
 if(val.length<6){lv=0;}
 if(val.length >7 ){lv++;}
 //lv=0/1时为弱口令;lv=2/3为中口令;lv>3为强口令;
 if(lv>3){lv=3;}
 if(lv==3){lv=2;}
 this.oStrength.className = 'strengthLv' + lv;
 this.oStrengthTxt.innerHTML = aLvTxt[lv];
};
