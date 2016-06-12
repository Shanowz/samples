function main(){
//##### anonymous functions #####//
    (function(){
        console.log("annonymous function");
    })();
    //or
    anotherAnon = function(){
        console.log("a another anonymous function");
    };
    anotherAnon();

//##### optimised browser list with a loop for #####//
    aStringList = ["abc", "hi", "hello", "bonjour", "plop"];
    list_browser(aStringList);

//##### Usage of .apply's function parameter and arguments object #####//
    aNumberList = [5,7,9,5,4,7,6,8,7];
    console.log(averrageFunction.apply(null, aNumberList));

//##### Create a object's constructor and add a function to the constructor with .prototype parameter
    var tom = new Somebody("Tom", "Jefferson", 25);
    console.log(tom.name);
    tom.beOlder(62);
    console.log(tom.age);

    Somebody.prototype.goingtodie = function() {
        if(this.age > 80){
            return this.name+" will die soon";
        }else{
            return this.name+" is gonna have a great long life";
        }
    };
    console.log(tom.goingtodie());
}



//*******   FUNCTIONS ********//
function list_browser(alist){
    for(var i=0, item; item = alist[i]; i++){
        console.log(item);
    }
}

// use arguments parameter
function averrageFunction(){
    var sum = 0;
    for(var i= 0, item;item = arguments[i]; i++){
        sum += item;
    }
    return sum / arguments.length;
}

function Somebody(name, firstname, age){  //it's the constructor of somebody's object, this first letter's function name is UPPER
    this.name = name;
    this.firstName = firstname;
    this.age = age;

    this.beOlder = function(years){
        this.age += years;
    };
    this.beYounger = function(years){
        this.age -= years;
    };
}
