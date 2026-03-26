<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Keranjang</h1>

<div id="listKeranjang"></div>

<button onclick="checkout()">Checkout via WhatsApp</button>

<script>
function tampilkanKeranjang() {
    let keranjang = JSON.parse(localStorage.getItem('keranjang')) || [];

    document.getElementById('listKeranjang').innerHTML =
        keranjang.map((item, i) => `
            <div>
                ${item.nama} (x${item.qty})
                <button onclick="tambah(${i})">+</button>
                <button onclick="kurang(${i})">-</button>
            </div>
        `).join('');
}
</script>

</body>
</html>