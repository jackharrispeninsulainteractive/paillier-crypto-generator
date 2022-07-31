class Application {

    static instance = new Application();
    domain = "http://localhost";
    domainLocation = "/A2_Q1/";
    candidates;
    voters;
    privateKey;
    publicKey;

    constructor() {
        fetch(this.domain + this.domainLocation + "candidates.json").then(response => response.json()).then(data => {this.candidates = data.candidates; console.log(this.candidates)})
        fetch(this.domain + this.domainLocation + "voters.json").then(response => response.json()).then(data => {this.voters = data.voters; console.log(this.voters)})
    }

    generateKeys(){

        //load our variables from the form input
        let p = document.getElementById("p").valueOf().value;
        let q = document.getElementById("q").valueOf().value;
        let g =  bigInt(document.getElementById("g").valueOf().value);

        //next start to generate all the required numbers
        let n = bigInt(p*q);
        let n2 = n.pow(2);
        let lambda = this.lcm(p-1,q-1);
        let l = this.L(g.modPow(lambda, n2), n);
        let mu = l.modInv(n);

        //show the generated values in the form
        document.getElementById("n").valueOf().value = n;
        document.getElementById("lambda").valueOf().value = lambda;
        document.getElementById("l").valueOf().value = l;
        document.getElementById("mu").valueOf().value = mu;

        //finally we can go ahead and display the public and private keys
        this.publicKey = {"n": n, "g": g};
        this.privateKey = {"λ": lambda, "μ": mu, "n": n};
        document.getElementById("public-key").innerText = "Public Key: "+JSON.stringify(this.publicKey);
        document.getElementById("private-key").innerText = "Private Key: "+JSON.stringify(this.privateKey);
        document.getElementById("keys").style.display = "block";
        document.getElementById("encrypt").style.display = "block";
        document.getElementById("decrypt").style.display = "block";
        document.getElementById("addition").style.display = "block";
    }

    encrypt(){
        //create all the variable we will need to perform the encryption
        let m = document.getElementById("m").valueOf().value;
        let r = bigInt(document.getElementById("r").valueOf().value);
        let n  = bigInt(this.publicKey.n);
        let n2 = bigInt(this.publicKey.n.pow(2));
        let g = bigInt(this.publicKey.g);

        //perform our encryption and save the value into our c variable
        let c  = g.modPow(bigInt(m), n2).multiply(r.modPow(n,n2)).mod(n2);

        //finally output this variable to the document
        document.getElementById("c").valueOf().value = c;
        document.getElementById("decrypt-c").valueOf().value = c;
    }

    decrypt(outputTarget, c){

        //create and set the all the variable required for the decryption
        if(c === null){
            c = document.getElementById("decrypt-c").valueOf().value;
        }

        let lambda = this.privateKey.λ;
        let n2 = this.privateKey.n.pow(2);
        let mu = this.privateKey.μ
        let n = this.privateKey.n;

        //perform our decryption using all the variables above
        let m = this.L(bigInt(c).modPow(lambda, n2), n).multiply(mu).mod(n);

        //lastly we output the m variable back to the document
        if(outputTarget === null) {
            document.getElementById("decrypt-m").valueOf().value = m;
        }else{
            outputTarget.valueOf().value = m;
        }
    }

    homomorphicAddition(){
        //create our variables
        let c1 = document.getElementById("c1").valueOf().value;
        let c2 = document.getElementById("c2").valueOf().value;

        let c3 = bigInt(c1 * c2).mod(this.publicKey.n.pow(2));
        document.getElementById("addition-c-output").valueOf().value = c3;
        this.decrypt(document.getElementById("addition-m-output"),c3);
    }

    //lcm function based on promgramiz.com lcm example 1
    //https://www.programiz.com/javascript/examples/lcm
    lcm(number1, number2){

        let min = (number1 > number2) ? number1 : number2;

        while(true){
            if(min % number1 == 0 && min % number2 == 0){
                break;
            }
            min++;
        }

        return min;
    }

    //function based on the paillary.js package implementation
    //https://github.com/juanelas/paillier-js/blob/5af1f0ca3a032bd04da38850f008287eb4025e30/paillier.js#L119
    L(number1, number2) {
        return number1.subtract(1).divide(number2);
    }

}