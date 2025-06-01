<?php
$currentYear = date('Y');
?>

<footer class="bg-ck py-4 large-font mt-auto">
    <div class="container px-5">
        <div class="row align-items-center justify-content-between flex-column flex-sm-row">
            <div class="col text-center">
                <div class="small m-0 color-ck">
                    Copyright &copy; designed & developed with &#9829; by
                    <a class="text-decoration-none color-ck text-ck-special" href="https://kayacuneyt.com" target="_blank">
                        Cüneyt Kaya</a> <?php echo $currentYear; ?>
                </div>
            </div>
            <div class="col text-center">
                <a href="#top" class="color-ck text-decoration-none">
                    <i class="bi bi-arrow-bar-up"></i>
                    Back to top
                </a>
            </div>
            <div class="col text-center">
                <a class="color-ck small text-decoration-none" href="/privacy">Privacy</a>
                <span class="color-ck mx-1">&middot;</span>
                <a class="color-ck small text-decoration-none" href="/terms">Terms</a>
                <span class="text-white mx-1">&middot;</span>
                <a class="color-ck small text-decoration-none" href="/imprints">Imprints</a>
                <span class="text-white mx-1">&middot;</span>
                <a class="color-ck small text-decoration-none" target="_blank" href="https://github.com/kayacuneyd/kayacuneyt.com">My Source Code</a>
            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<?php include './assets/chatbot/chatbot.php'; ?>
</body>

</html>