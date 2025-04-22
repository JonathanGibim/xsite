<!-- Main Footer -->
<footer class="main-footer">
	<strong>Copyright &copy; <?php echo date("Y"); ?> - Tema por: <a href="https://adminlte.io/themes/v3/" target="_blank">AdminLTE.io</a> - Sistema por: <a href="https://www.xweb.com.br" target="_blank">Xweb.com.br</a>.</strong>
	<div class="float-right d-none d-sm-inline-block">
		sis_xweb - version 1.0.0
	</div>
</footer>
</div>
<!-- ./wrapper -->


<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE SCRIPTS -->
<script src="dist/js/main.js"></script>

<!-- Toastr -->
<?php 
if(in_array("toastr", $arrRecursos) AND !empty($_SESSION['alert-float'])){
    ?>
    <script src="plugins/toastr/toastr.min.js"></script>
    <script type="text/javascript">
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
        <?php echo $_SESSION['alert-float']; ?>
    </script>
    <?php 
    unset($_SESSION['alert-float']);
}
?>

<!-- inputmask -->
<?php if(in_array("inputmask", $arrRecursos)){ ?>
    <script src="plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
    <script type="text/javascript">
        $(".mask-tel-cel").inputmask({
            mask: ["(99) 9999-9999", "(99) 99999-9999", ],
            keepStatic: true
        });
    </script>
<?php } ?>

<!-- Color Picker -->
<?php if(in_array("colorpicker", $arrRecursos)){ ?>
    <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <script type="text/javascript">
        //color picker primaria
        $('.my-colorpicker2').colorpicker()
        $('.my-colorpicker2').on('colorpickerChange', function(event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        })
        //color picker primaria
        $('.my-colorpicker2-sec').colorpicker()
        $('.my-colorpicker2-sec').on('colorpickerChange', function(event) {
            $('.my-colorpicker2-sec .fa-square').css('color', event.color.toString());
        })   
    </script>
<?php } ?>

<!-- Select2 -->
<?php if(in_array("lightbox2", $arrRecursos)){ ?>
    <link href="plugins/lightbox2/css/lightbox.css" rel="stylesheet" />
    <script src="plugins/lightbox2/js/lightbox.js"></script>
<?php } ?>

<!-- Select2 -->
<?php if(in_array("select2", $arrRecursos)){ ?>
    <script src="plugins/select2/js/select2.full.min.js"></script>
    <script src="plugins/select2/js/i18n/pt-BR.js"></script>
    <script type="text/javascript">

        $('.select2').select2({
            language: "pt-BR",
        });

        /*
        $('.select2-create').select2({
            language: "pt-BR",
            tags : true,
            tokenSeparators : [ ',' ],
            createTag: function (params) {
                var term = $.trim(params.term);
                if (term === '') {
                    return null;
                }
                return {
                    id: term,
                    text: term,
                    newTag: true
                }
            }
        });
        $('.select2-create').on('select2:select', function (e) {
            let tag = e.params.data;
            if (tag.newTag === true){
                let formData = new FormData();
                formData.append("termo", tag.text);
                $.ajax({
                    url: "<?php echo URL_ATUAL; ?>",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                    }
                });
            }
        });
        */
    </script>
<?php } ?>

<?php if(in_array("pagina-cad-edit", $arrRecursos)){ ?>
    <script type="text/javascript">
        $(document).ready(function () {
            function preencheCampos(){
                if($("#id_menu").val() != ''){
                    $('#nome').val($("#id_menu option:selected").text().trim());
                }else{
                    $('#nome').val('');
                }
            }
            function escondeCampos(){
                if($("#id_menu").val() != ''){
                    $('#campo_link').hide();
                }else{
                    $('#campo_link').show();
                }
            }
            $("#id_menu").change(function () {
                escondeCampos();
                preencheCampos();
            })
            escondeCampos();
        });
    </script>
<?php } ?>

<?php if(in_array("categoria-cadastrar", $arrRecursos)){ ?>
<!-- Modal categoria -->
<div class="modal fade" id="categoriaModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nova Categoria</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="mt-1" id="categoriaAlerta"></div>
                <form id="categoriaForm">
                    <div class="form-group">
                        <label>Categoria Superior (opcional)</label>
                        <select class="form-control select2" name="idSuperior" id="categoriaSuperiorModal">
                            <option selected>Selecione o Categoria Superior</option>
                            <?php
                            if($arrCategoriaSuperior){
                                foreach ($arrCategoriaSuperior as $objCategoriaSuperior) {
                                    ?>
                                    <option value="<?php echo $objCategoriaSuperior->getId(); ?>" >
                                        <?php echo $objCategoriaSuperior->getNomeNiveis(); ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Nome">Nome</label>
                        <input type="text" maxlength="250" class="form-control" id="nome" name="nome" placeholder="Nome">
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $("#categoriaForm").submit(function(e) {
        e.preventDefault();
        var form_data = new FormData($(this)[0]);
        form_data.append("add-categoria-modal", 1);
        $.ajax({
            url: "<?php echo $urlAdminModulo; ?>categoria-cadastrar",
            method: "POST",
            data: form_data,
            processData: false,
            contentType: false,
            success: function(response) {
                response = JSON.parse(response);
                if(response[0] == 1){
                    $("#categoriaForm")[0].reset();
                    $("#categoriaModal").modal("hide");
                    var id = response[2];
                    var nome_niveis = response[3];
                    var newOption = new Option(nome_niveis, id, false, true);
                    $('#categoriaMultiple').append(newOption).trigger('change');
                    var newOption = new Option(nome_niveis, id, false, false);
                    $('#categoriaSuperiorModal').append(newOption).trigger('change');
                }else{
                    $("#categoriaAlerta").html(response[1]);
                }
            }
        });
    });
</script>
<?php } ?>


<?php if(in_array("tag-cadastrar", $arrRecursos)){ ?>
<!-- Modal tag -->
<div class="modal fade" id="tagModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nova Tag</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="mt-1" id="tagAlerta"></div>
                <form id="tagForm">
                    <div class="form-group">
                        <label for="Nome">Nome</label>
                        <input type="text" maxlength="250" class="form-control" id="nome" name="nome" placeholder="Nome">
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $("#tagForm").submit(function(e) {
        e.preventDefault();
        var form_data = new FormData($(this)[0]);
        form_data.append("add-tag-modal", 1);
        $.ajax({
            url: "<?php echo $urlAdminModulo; ?>tag-cadastrar",
            method: "POST",
            data: form_data,
            processData: false,
            contentType: false,
            success: function(response) {
                response = JSON.parse(response);
                if(response[0] == 1){
                    $("#tagForm")[0].reset();
                    $("#tagModal").modal("hide");
                    var id = response[2];
                    var nome = response[3];
                    var newOption = new Option(nome, id, false, true);
                    $('#tagMultiple').append(newOption).trigger('change');
                    var newOption = new Option(nome, id, false, false);
                    $('#tagModal').append(newOption).trigger('change');
                }else{
                    $("#tagAlerta").html(response[1]);
                }
            }
        });
    });
</script>
<?php } ?>

<!-- DataTables -->
<?php if(in_array("data-table", $arrRecursos)){ ?>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(".data-table").DataTable({
            "responsive": true,
            "autoWidth": false,
            "iDisplayLength": 25,
            "language": {
                "url": "plugins/datatables/pt-br.lang"
            }
        });
        $(".data-table-2").DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "iDisplayLength": 25,
        });
        $(".data-table-3").DataTable({
            "responsive": true,
            "autoWidth": false,
            "ordering": false,
            "iDisplayLength": 25,
            "language": {
                "url": "plugins/datatables/pt-br.lang"
            }
        });

    </script>
<?php } ?>

<!-- SweetAlert2 -->
<?php if(in_array("sweet-alert", $arrRecursos)){ ?>
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <script type="text/javascript">
        function btn_excluir(url, id_exc) {
            id = url.split("/").slice(-1);
            Swal.fire({
                title: 'Excluir',
                text: "Tem certeza que deseja excluir esse registro?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.value == true) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        dataType: 'html',
                        data: null,
                    })
                    .done(function(bol) {
                        if(bol == 1){
                            console.log("success");
                            Swal.fire('Excluído!', 'Registro excluído com sucesso', 'success');
                            $("#"+id_exc).fadeOut(300);
                        }else{
                            console.log("error");
                            Swal.fire('Erro!', 'Ocorreu um erro ao excluir', 'error');
                        }
                    })
                    .fail(function() {
                        console.log("error");
                    })
                    .always(function() {
                        console.log("complete");
                    });
                }
            })
        }
    </script>
<?php } ?>

<!-- Bootstrap Switch -->
<?php if(in_array("bootstrap-switch", $arrRecursos)){ ?>
    <script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <script type="text/javascript">
        $("input[data-bootstrap-switch]").each(function(){
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        });
    </script>
<?php } ?>

<!-- Summernote -->
<?php if(in_array("summernote", $arrRecursos)){ ?>
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <script>
        $(function () {
            $('.textarea').summernote()
        });
    </script>
<?php } ?>


<!-- Bootstrap Switch -->
<?php if(in_array("ordenar", $arrRecursos)){ ?>
    <script>
        function moverCima(botao, action) {
            let linha = botao.closest("tr");
            let anterior = linha.previousElementSibling;
            if (anterior) {
                linha.parentNode.insertBefore(linha, anterior);
            ordenar(action); // Salvar automaticamente
        }
    }

    function moverBaixo(botao, action) {
        let linha = botao.closest("tr");
        let proximo = linha.nextElementSibling;
        if (proximo) {
            linha.parentNode.insertBefore(proximo, linha);
            ordenar(action); // Salvar automaticamente
        }
    }

    function ordenar(action) {
        let ordem = [];
        document.querySelectorAll(".table tbody tr").forEach((linha, index) => {
            ordem.push({
                id: linha.getAttribute("data-id"),
                ordem: index + 1
            });
        });
        var url = "<?php echo $urlAdminModulo; ?>ordenar";
        if(action){
            var url = "<?php echo $urlAdminModulo; ?>"+action;
        }
        $.ajax({
            url: url,
            type: "POST",
            data: { ordem: JSON.stringify(ordem) },
            success: function(response) {
                console.log("Ordem salva:", response);
            }
        });
    }
</script>
<?php } ?>


<!-- Cropper.js -->
<?php if(in_array("cropperjs", $arrRecursos)){ ?>

    <!-- Modal para edição da imagem -->
    <div class="modal fade" id="cropModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajustar Imagem</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="cropImage" src="" class="w-100">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="cropBtn" class="btn btn-primary">Cortar e Enviar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="plugins/cropperjs/cropper.min.css">
    <script src="plugins/cropperjs/cropper.min.js"></script>
    <script>
        $(document).ready(function() {
            let cropper;
            let canvas;

    // Abrir modal e inicializar Cropper.js
            $("#imageInput").change(function(event) {
                let files = event.target.files;
                if (files && files.length > 0) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        $("#cropImage").attr("src", e.target.result);
                        $("#cropModal").modal("show");
                    };
                    reader.readAsDataURL(files[0]);
                }
            });

    // Inicializar Cropper.js quando o modal for aberto
            $("#cropModal").on("shown.bs.modal", function() {
                let image = document.getElementById("cropImage");
                cropper = new Cropper(image, {
            aspectRatio: 1, // Alterar a proporção se necessário
            //viewMode: 2,
            autoCropArea: 1
        });
            });

    // Remover Cropper.js quando o modal for fechado
            $("#cropModal").on("hidden.bs.modal", function() {
                cropper.destroy();
                cropper = null;
            });

    // Capturar imagem recortada e enviar via AJAX
            $("#cropBtn").click(function() {
                canvas = cropper.getCroppedCanvas({
            width: 300, // Ajustar para o tamanho desejado
            height: 300
        });

    // Exibir prévia
                $("#croppedPreview").addClass('img-thumbnail');
                $("#croppedPreview").attr("src", canvas.toDataURL());

    // Envia para upload
                canvas.toBlob(function(blob) {
                    let formData = new FormData();
                    formData.append("croppedImage", blob, "cropped.png");
                    $.ajax({
                        url: "<?php echo URL_ATUAL; ?>",
                        method: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            response = JSON.parse(response);
                            if(response[0] == 1){
                                $("#imagem").val(response[1]);
                            }else{
                                console.log(response[1]);
                                alert(response[1]);
                            }
                        }
                    });
                });

                $("#cropModal").modal("hide");
            });
        });
    </script>
<?php } ?>
</body>
</html>