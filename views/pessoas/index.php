<?php



// $paginator = new Paginator('10','p');
//pass number of records to
// $paginator->set_total($stmt->rowCount());

// $stmt 	= $pdo->prepare($sql);
// $stmt->execute();
// die(print_r($paginator->page_links(),1));
?>
<div id="top" class="row top-buffer">
    <div class="col-md-4">
        <h3>Lista de Pessoas</h3>
    </div>

    <div class="col-md-4">
        <form method='POST' action="<?php echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>">
            <div class="input-group h2">
                 <input name="search" class="form-control" id="search" type="text" placeholder="Pesquisar...">
                 <span class="input-group-btn">
                         <button class="btn btn-primary" type="submit">
                             <i class="fa fa-fw" aria-hidden="true" title="Copy to use search"></i>
                         </button>
                 </span>
             </div>
         </form>
    </div>

    <div class="col-md-4">
        <a href="index.php?controller=pessoas&action=create" data-target="#default-modal" data-toggle="modal" class="btn btn-primary pull-right h2">Novo Item</a>
    </div>
</div> <!-- /#top -->

<table class="table table-striped table-hover top-buffer">
  <thead>
    <tr>
      <th>#</th>
      <th>Nome</th>
      <th>Gênero</th>
      <th>Estado Civil</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
<?php while ($row = $pessoasList->fetch()):?>
    <tr>
      <th scope="row"><?php echo $row['id'] ?></th>
      <td><?php echo $row['nome'] ?></td>
      <td><?php echo $row['genero'] ?></td>
      <td><?php echo $row['estado_civil'] ?></td>
      <td>
          <button type="button" class="btn btn-danger" onclick="excluirItem(<?php echo $row['id'] ?>);">
              <i class="fa fa-trash-o" aria-hidden="true"></i>
          </button>
          <button type="button" class="btn btn-primary" href="index.php?controller=pessoas&action=edit&id=<?php echo $row['id'] ?>" data-target="#default-modal" data-toggle="modal">
              <i class="fa fa-edit" aria-hidden="true"></i>
          </button>
      </td>
    </tr>
<?php endwhile;?>
  </tbody>
</table>

<!-- Default Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          Remover Item
      </div>
      <div class="modal-body">
          Deseja Realmente excluir esse item?
          <form action="index.php?controller=pessoas&action=destroy" method="POST" id="form-delete-item">
              <input name="id" type="hidden" value="">
          </form>
      </div>
      <div class="modal-footer">
          <a href="index.html" class="btn btn-default" data-dismiss="modal">Cancelar</a>
          <button type="button" onclick="$('#form-delete-item').submit();"class="btn btn-primary" id="excluirItem">Excluir</button>
      </div>
    </div>
  </div>
</div> <!-- /.modal -->

<ul class="pagination pagination-lg justify-content-end">
    <?php if ($paginator->getPrevUrl()): ?>
        <li class="page-item"><a class="page-link" href="<?php echo $paginator->getPrevUrl(); ?>">&laquo; Anterior</a></li>
    <?php endif; ?>

    <?php foreach ($paginator->getPages() as $page): ?>
        <?php if ($page['url']): ?>
            <li class="page-item <?php echo $page['isCurrent'] ? 'active' : ''; ?>">
                <a class="page-link" href="<?php echo $page['url']; ?>"><?php echo $page['num']; ?></a>
            </li>
        <?php else: ?>
            <li class="page-item disabled"><span><?php echo $page['num']; ?></span></li>
        <?php endif; ?>
    <?php endforeach; ?>

    <?php if ($paginator->getNextUrl()): ?>
        <li class="page-item"><a class="page-link" href="<?php echo $paginator->getNextUrl(); ?>">Próximo &raquo;</a></li>
    <?php endif; ?>
</ul>



<!-- <script>
$('#create-pessoas').on('submit', function(event){
    console.log('dsdsds');
    event.preventDefault();
    $.ajax({
        url: $(form).attr('action'),
        type: "POST",
        data: new FormData($(form)),
        cache: false,
        processData: false,
        success: function(data) {
            $('#loading').hide();
            $("#message").html(data);
        }
    });
}); -->
<script>
    function excluirItem(id){
        $('#form-delete-item [name=id]').val(id);
        $('#delete-modal').modal();
    }

    // $(document).on('show.bs.modal','#default-modal',function(event){
    //       console.log('Modal opened', $(event.relatedTarget).attr('href'));
    //   });
</script>
