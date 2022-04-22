<?php
include "header.html";
?>
<div class="container-fluid my-5">
    <h1 class="text-center mb-3">KRIPTOGRAFI</h1>
    <textarea class="form-control border-3 border-dark mb-3" id="data" style="height: 200px;" placeholder="Masukkan Kalimat"></textarea>
    <div class="text-center mb-3">
        <button id="btnEnc" type="button" class="btn btn-primary my-3 font-weight-bold mx-2">Enkripsi</button>
        <button id="btnDec" type="button" class="btn btn-warning my-3 font-weight-bold mx-2">Dekripsi</button>
        <button id="btnClr" type="button" class="btn btn-danger my-3 font-weight-bold mx-2">Clear</button>
        <button id="btnCopy" type="button" class="btn btn-success my-3 font-weight-bold mx-2">Copy</button>
    </div>
    <div class="text-center">Created By : Doni Firmansyah (Last Update : 22/04/22)</div>
</div>
<?php
include "footer.html";
?>