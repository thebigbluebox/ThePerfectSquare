var alphabets = ["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z"];
var alpha = {};

for(var i = 0; i < alphabets.length; i++){
	alpha[alphabets[i]] = i; //assigns each alphabet a integer key
}

function newAlpha(inputChar){
	alphabets.push(inputChar);
	mapfunc();
	genVernier("venmatrix");
}

function alphaset(inputString){
	alphabets = inputString.split("");
	mapfunc();
	genVernier("venmatrix");
}

function returnsalphaset(){
	return 	alphabets.join("");
}

function mapfunc(){ //creates a mapping of the alphabets
	for(var i = 0; i < alphabets.length; i++){
		alpha[alphabets[i]] = i; //assigns each alphabet a integer key
	}
}

Number.prototype.mod = function(n) { return ((this%n)+n)%n; } 

function verniercipher(inputString, keyString, flag){
	var outputArray = new Array(inputString.length);
	var inputStringArray = inputString.toUpperCase().split('');
	var keyArray = keyString.toUpperCase().split('');
	var counter = 0;

	for(var i = 0; i < outputArray.length ; i++)
	{
		if(flag == true)
		{
			outputArray[i] = alphabets[(alpha[inputStringArray[i]] + alpha[keyArray[counter]]).mod(alphabets.length-1)];		
		}
		else
		{
			outputArray[i] = alphabets[(alpha[inputStringArray[i]] - alpha[keyArray[counter]]).mod(alphabets.length-1)];		
		}
		if((counter + 1) >= keyArray.length)
		{
			counter = 0; //Resets the keyArray Counter so it continues from zero again 
		}
		else
		{
			counter ++;
		}
	}
	return outputArray.join("");
}

function ceasercipher(inputString, shift, flag){
	var outputArray = new Array(inputString.length);
	var inputStringArray = inputString.toUpperCase().split('');
	var counter = 0;

	for(var i = 0; i < outputArray.length ; i++)
	{
		
		if(flag == true)
		{
			outputArray[i] = alphabets[(alpha[inputStringArray[i]] + shift).mod(alphabets.length-1)];		
		}
		else
		{
			outputArray[i] = alphabets[(alpha[inputStringArray[i]] - shift).mod(alphabets.length-1)];		
		}
	}
	return outputArray.join("");	
}

function Encipher(){
	document.getElementById("cipheredtext").value = verniercipher(document.getElementById("plaintext").value , document.getElementById("key").value, true);
}

function Decipher(){
	document.getElementById("plaintext").value = verniercipher(document.getElementById("cipheredtext").value , document.getElementById("key").value, false);
}

function genVernier(name) {
    var myTableDiv = document.getElementById(name);
    if(document.getElementById("genVernier")){
    	$('#genVernier').remove();
    }

    var table = document.createElement('TABLE');
    table.setAttribute("id", "genVernier");
    var tableBody = document.createElement('TBODY');

    table.border = '0'
    table.appendChild(tableBody);


    //TABLE COLUMNS
    var tr = document.createElement('TR');
    
    for (i = 0; i <= alphabets.length; i++) {
        var th = document.createElement('TH')
        th.width = '10';
        if(i == 0){
        	th.appendChild(document.createTextNode(" "));
        	tr.appendChild(th);
        }
        else{
	        th.appendChild(document.createTextNode(alphabets[i-1]));
	        tr.appendChild(th);	
        }
    }
    tableBody.appendChild(tr);

    //TABLE ROWS
    for (i = 0; i < alphabets.length; i++) {
        var tr = document.createElement('TR');
        
        for (j = 0; j <= alphabets.length; j++) {
            var td = document.createElement('TD')
            if(j == 0){
        		td.appendChild(document.createTextNode(alphabets[i]));
        		tr.appendChild(td);
	        }
	        else{
            	td.appendChild(document.createTextNode(alphabets[(alpha[alphabets[i]] + alpha[alphabets[j-1]]).mod(alphabets.length)]));
            	tr.appendChild(td)
            }
        }
        tableBody.appendChild(tr);
    }  
    myTableDiv.appendChild(table)
}

$(document).ready(function() {
    	genVernier("venmatrix");
    	document.getElementById("charsetinput").value = returnsalphaset();
    	$("#charsetupdate").click(function(){
			alphabets = document.getElementById("charsetinput").value.split("");
			mapfunc();
			genVernier("venmatrix");
		});
		$("#encipherbutton").click(function(){
			Encipher();
		});
		$("#decipherbutton").click(function(){
			Decipher();
		});
});

