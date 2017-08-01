<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Administrador</title>
    <link rel="icon" href="http://upload.dinhosting.fr/t/X/F/favicon.ico">
    <link href="http://localhost/crud-demo/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/rowreorder/1.2.0/css/rowReorder.dataTables.min.css" rel="stylesheet">
	<link href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
<body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" style="color:#fff" href="http://localhost/olharcidadao/admin/">Início</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav ">
            <li><a href="">Link</a></li>
          </ul>
          <div class="nav navbar-nav navbar-right">
            <li><a href="" style="color:#F3F3F3"> Link </a></li>
          </div>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container" style="margin-top:60px">
        <h2>Olá Administrador!</h2>
        <h3 style="text-decoration:underline">Categorias</h3>
        <button class="btn btn-success" onclick="add()"><i class="glyphicon glyphicon-plus"></i>Adicionar Categoria</button>
        <button class="btn btn-default" onclick="reloadTableCategoria()"><i class="glyphicon glyphicon-refresh"></i>Atualizar</button>
        <button id="deleteListCategoria" class="btn btn-danger" style="display: none;" onclick="deleteListCategoria()"><i class="glyphicon glyphicon-trash"></i>Deletar Lista</button>
        <br />
        <br />
        <table id="tableCategoria" class="display nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><input type="checkbox" id="check-all-categoria"></th>
                    <th>Nome</th>
                    <th style="width:150px;">Ações</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
        </table><br /><br /><br />

        <h3 style="text-decoration:underline">Publicações</h3>
        <button class="btn btn-default" onclick="reloadTablePublicacao()"><i class="glyphicon glyphicon-refresh"></i>Atualizar</button>
        <button id="deleteListPublicacao" class="btn btn-danger" style="display: none;" onclick="deleteListPublicacao()"><i class="glyphicon glyphicon-trash"></i>Deletar Lista</button>
        <br />
        <br />
        <table id="tablePublicacao" class="display nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><input type="checkbox" id="check-all-publicacao"></th>
                    <th>Título</th>
                    <th style="width:150px;">Ações</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Título</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
        </table><br /><br /><br />

        <h3 style="text-decoration:underline">Usuários</h3>
        <button class="btn btn-default" onclick="reloadTableUsuario()"><i class="glyphicon glyphicon-refresh"></i>Atualizar</button>
        <button id="deleteListUsuario" class="btn btn-danger" style="display: none;" onclick="deleteListUsuario()"><i class="glyphicon glyphicon-trash"></i>Deletar Lista</button>
        <br />
        <br />
        <table id="tableUsuario" class="display nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th><input type="checkbox" id="check-all-usuario"></th>
                    <th>Nome do Usuário</th>
                    <th style="width:150px;">Ações</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Nome do Usuário</th>
                    <th>Ações</th>
                </tr>
            </tfoot>
        </table><br /><br /><br />
    </div>
	
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.2.0/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
	

<script src="http://localhost/crud-demo/assets/bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">

var save_method; //for save method string
var table1;
var table2;
var table3;

$(document).ready(function() {

    //datatables
    table1 = $('#tableCategoria').DataTable({
		

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "index.php/admin/ajax_list_categoria",
            "type": "POST"
        },
		
        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": [ 0 ], //first column
                "orderable": false, //set not orderable
            },
            {
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },

        ],
		
		rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true

    });

    table2 = $('#tablePublicacao').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "index.php/admin/ajax_list_publicacao",
            "type": "POST"
        },			

        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": [ 0 ], //first column
                "orderable": false, //set not orderable
            },
            {
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },

        ],
		
		rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true

    });
	
    table3 = $('#tableUsuario').DataTable({

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "index.php/admin/ajax_list_usuario",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
            {
                "targets": [ 0 ], //first column
                "orderable": false, //set not orderable
            },
            {
                "targets": [ -1 ], //last column
                "orderable": false, //set not orderable
            },

        ],
		
		rowReorder: {
            selector: 'td:nth-child(2)'
        },

        responsive: true

    });	
	
	
    //set input/textarea/select event when change value, remove class error and remove text help block
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

    //check all
    $("#check-all-categoria").click(function () {
        $(".data-check").prop('checked', $(this).prop('checked'));
        showBottomDeleteCategoria();
    });
	
	$("#check-all-publicacao").click(function () {
        $(".data-check").prop('checked', $(this).prop('checked'));
        showBottomDeletePublicacao();
    });
	
	$("#check-all-usuario").click(function () {
        $(".data-check").prop('checked', $(this).prop('checked'));
        showBottomDeleteUsuario();
    });



});

function showBottomDeleteCategoria()
{
  var total = 0;

  $('.data-check').each(function()
  {
     total+= $(this).prop('checked');
  });

  if (total > 0)
      $('#deleteListCategoria').show();
  else
      $('#deleteListCategoria').hide();
}


function showBottomDeletePublicacao()
{
  var total = 0;

  $('.data-check').each(function()
  {
     total+= $(this).prop('checked');
  });

  if (total > 0)
      $('#deleteListPublicacao').show();
  else
      $('#deleteListPublicacao').hide();
}

function showBottomDeleteUsuario()
{
  var total = 0;

  $('.data-check').each(function()
  {
     total+= $(this).prop('checked');
  });

  if (total > 0)
      $('#deleteListUsuario').show();
  else
      $('#deleteListUsuario').hide();
}
function add()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Adicionar'); // Set Title to Bootstrap modal title
}

function edit(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "index.php/admin/ajax_edit/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data.id);
            $('[name="nome"]').val(data.nome);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Erro ao obter dados do ajax.');
        }
    });
}

function reloadTableCategoria()
{
    table1.ajax.reload(null,false); //reload datatable ajax
    $('#deleteListCategoria').hide();
}

function reloadTablePublicacao()
{
    table2.ajax.reload(null,false); //reload datatable ajax
    $('#deleteListPublicacao').hide();
}

function reloadTableUsuario()
{
    table3.ajax.reload(null,false); //reload datatable ajax
    $('#deleteListUsuario').hide();
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;

    if(save_method == 'add') {
        url = "index.php/admin/ajax_add";
    } else {
        url = "index.php/admin/ajax_update";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                $('#modal_form').modal('hide');
                reloadTableCategoria();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++)
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('Salvar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Erro ao adicionar / atualizar dados');
            $('#btnSave').text('Salvar'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable

        }
    });
}

function deleteCategoria(id)
{
    if(confirm('Tem certeza que deseja remover ?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "index.php/admin/ajax_delete_categoria/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reloadTableCategoria();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Ocorreu um erro!');
            }
        });

    }
}

function deletePublicacao(id)
{
    if(confirm('Tem certeza que deseja remover ?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "index.php/admin/ajax_delete_publicacao/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reloadTablePublicacao();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Ocorreu um erro!');
            }
        });

    }
}

function deleteUsuario(usuario_nome)
{
    if(confirm('Tem certeza que deseja remover ?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "index.php/admin/ajax_delete_usuario/"+usuario_nome,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reloadTableUsuario();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Ocorreu um erro!');
            }
        });

    }
}

function deleteListCategoria()
{
    var list_id = [];
    $(".data-check:checked").each(function() {
            list_id.push(this.value);
    });
    if(list_id.length > 0)
    {
        if(confirm('Tem certeza que deseja excluir '+list_id.length+' categorias ?'))
        {
            $.ajax({
                type: "POST",
                data: {id:list_id},
                url: "index.php/admin/ajax_list_delete_categoria",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        reloadTableCategoria();
                    }
                    else
                    {
                        alert('Falhou.');
                    }

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Ocorreu um erro!');
                }
            });
        }
    }
    else
    {
        alert('Nenhum dado selecionado!');
    }
}

function deleteListPublicacao()
{
    var list_id = [];
    $(".data-check:checked").each(function() {
            list_id.push(this.value);
    });
    if(list_id.length > 0)
    {
        if(confirm('Tem certeza que deseja excluir '+list_id.length+' categorias ?'))
        {
            $.ajax({
                type: "POST",
                data: {id:list_id},
                url: "index.php/admin/ajax_list_delete_publicacao",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        reloadTablePublicacao();
                    }
                    else
                    {
                        alert('Falhou.');
                    }

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Ocorreu um erro!');
                }
            });
        }
    }
    else
    {
        alert('Nenhum dado selecionado!');
    }
}

function deleteListUsuario()
{
    var list_id = [];
    $(".data-check:checked").each(function() {
            list_id.push(this.value);
    });
    if(list_id.length > 0)
    {
        if(confirm('Tem certeza que deseja excluir '+list_id.length+' categorias ?'))
        {
            $.ajax({
                type: "POST",
                data: {id:list_id},
                url: "index.php/admin/ajax_list_delete_usuario",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        reloadTableUsuario();
                    }
                    else
                    {
                        alert('Falhou.');
                    }

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Ocorreu um erro!');
                }
            });
        }
    }
    else
    {
        alert('Nenhum dado selecionado!');
    }
}

</script>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Categorias</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <div class="form-body">
                      <div class="form-group">
                          <div class="col-md-9">
                              <input name="id" class="form-control" type="hidden">
                              <span class="help-block"></span>
                          </div>
                      </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Nome</label>
                            <div class="col-md-9">
                                <input name="nome" placeholder="Nome" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Salvar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
</body>
</html>
