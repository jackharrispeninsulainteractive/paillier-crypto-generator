<?php
/**
 * Copyright Jack Harris
 * Peninsula Interactive - A2_Q1
 * Last Updated - 26/07/2022
 */
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Privacy Preserving Online Voting System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

</head>
<body>

<main>
    <section>
        <h1>Privacy Preserving Online Voting System</h1>
    </section>
    <section>
        <h2>Generate Keys</h2>
        <form action="Javascript:Application.instance.generateKeys()">
            <label>
                <p>p (Prime Number 1)</p>
                <input type="number" required id="p">
            </label>
            <label>
                <p>q (Prime Number 2)</p>
                <input type="number" required id="q">
            </label>
            <label>
                <p>g</p>
                <input type="number" required id="g">
            </label>
            <label class="auto-generated">
                <p>n (Auto Generated)</p>
                <input type="number" disabled id="n">
            </label>
            <label class="auto-generated">
                <p>λ (Auto Generated)</p>
                <input type="number" disabled id="lambda">
            </label>
            <label class="auto-generated">
                <p>L (Auto Generated)</p>
                <input type="number" disabled id="l">
            </label>
            <label class="auto-generated">
                <p>μ (Auto Generated)</p>
                <input type="number" disabled id="mu">
            </label>
            <label id="Blank label to force submit to new line"></label>
            <input type="submit" value="Generate">
        </form>
    </section>
    <section id="keys" style="display: none;">
        <h2>Keys</h2>
        <p>Keys are composed of multiple parts for both private and public, here the components are shown in json format below,</p>
        <br>
        <p id="public-key"></p>
        <p id="private-key"></p>
        <br>
    </section>

    <section id="encrypt" style="display: none;">
        <h2>Encrypt</h2>
        <form action="Javascript:Application.instance.encrypt()">
            <label>
                <p>message (Your input value)</p>
                <input type="number" id="m" required>
            </label>
            <label>
                <p>r (Your r value)</p>
                <input type="number" id="r" required>
            </label>
            <label class="auto-generated">
                <p>cipher (Auto Generated Encrypted Message)</p>
                <input type="number" id="c">
            </label>
            <label id="Blank label to force submit to new line"></label>
            <input type="submit" value="Encrypt">
        </form>
        <br>
    </section>

    <section id="decrypt" style="display: none;">
        <h2>Decrypt</h2>
        <form action="Javascript:Application.instance.decrypt(null,null)">
            <label>
                <p>cipher (Your encrypted cipher value)</p>
                <input type="number" id="decrypt-c" required>
            </label>
            <label class="auto-generated">
                <p>message (Auto Generated Decrypted Message)</p>
                <input type="number" id="decrypt-m">
            </label>
            <input type="submit" value="Decrypt">
        </form>
        <br>
    </section>

    <section id="addition" style="display: none;">
        <h2>Addition</h2>
        <form action="Javascript:Application.instance.homomorphicAddition()">
            <label>
                <p>cipher 1 (Your first cipher value)</p>
                <input type="number" id="c1" required>
            </label>
            <label>
                <p>cipher 2 (Your second cipher value)</p>
                <input type="number" id="c2" required>
            </label>
            <label class="auto-generated">
                <p>cipher (Auto Generated Cipher)</p>
                <input type="number" id="addition-c-output" disabled>
            </label>
            <label class="auto-generated">
                <p>message (Auto Generated Decrypted Message)</p>
                <input type="number" id="addition-m-output" disabled>
            </label>
            <input type="submit" value="Perform Addition">
        </form>
        <br>
    </section>
</main>
<br>
<footer>
    <p style="text-align: center">Created by Jack Harris 31/07/2022</p>
</footer>

</body>
<script src="BigInteger.min.js"></script>
<script src="Application.js"></script>
</html>