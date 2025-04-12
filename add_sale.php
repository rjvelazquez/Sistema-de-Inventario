<?php
  $page_title = 'Agregar venta';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(3);
?>
<?php

  if(isset($_POST['add_sale'])){
    $req_fields = array('products', 'date');
    validate_fields($req_fields);
    if(empty($errors)){
      $products = json_decode($_POST['products'], true); // Decode JSON data for products
      $date = $db->escape($_POST['date']);
      $s_date = make_date();
      $invoice_id = uniqid('INV-'); // Generate unique invoice ID

      foreach($products as $product) {
        $p_id = $db->escape((int)$product['id']);
        $s_qty = $db->escape((int)$product['quantity']);
        $s_total = $db->escape($product['total']);

        $sql  = "INSERT INTO sales (invoice_id, product_id, qty, price, date) VALUES (";
        $sql .= "'{$invoice_id}', '{$p_id}', '{$s_qty}', '{$s_total}', '{$s_date}'";
        $sql .= ")";

        if($db->query($sql)){
          update_product_qty($s_qty, $p_id);
        } else {
          $session->msg('d', 'Lo siento, registro falló para un producto.');
          redirect('add_sale.php', false);
        }
      }

      $session->msg('s', "Venta agregada con factura ID: {$invoice_id}");
      redirect('add_sale.php', false);
    } else {
      $session->msg("d", $errors);
      redirect('add_sale.php', false);
    }
  }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-6">
    <?php echo display_msg($msg); ?>
    <form method="post" action="ajax.php" autocomplete="off" id="sug-form">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-btn">
              <button type="submit" class="btn btn-primary">Búsqueda</button>
            </span>
            <input type="text" id="sug_input" class="form-control" name="title"  placeholder="Buscar por el nombre del producto">
         </div>
         <div id="result" class="list-group"></div>
        </div>
    </form>
  </div>
</div>
<div class="row">

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Agregar Venta</span>
        </strong>
      </div>
      <div class="panel-body">
        <form method="post" action="add_sale.php" id="sale-form">
          <table class="table table-bordered" id="product-table">
            <thead>
              <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Total</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="text" name="product_name[]" class="form-control" placeholder="Nombre del producto"></td>
                <td><input type="number" name="price[]" class="form-control" placeholder="Precio"></td>
                <td><input type="number" name="quantity[]" class="form-control" placeholder="Cantidad"></td>
                <td><input type="number" name="total[]" class="form-control" placeholder="Total" readonly></td>
                <td><button type="button" class="btn btn-danger remove-row">Eliminar</button></td>
              </tr>
            </tbody>
          </table>
          <button type="button" class="btn btn-primary" id="add-row">Agregar Producto</button>
          <div class="form-group">
            <label for="date">Fecha</label>
            <input type="date" name="date" class="form-control" required>
          </div>
          <button type="submit" name="add_sale" class="btn btn-success">Guardar Venta</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById('add-row').addEventListener('click', function() {
    const table = document.getElementById('product-table').getElementsByTagName('tbody')[0];
    const newRow = table.rows[0].cloneNode(true);
    newRow.querySelectorAll('input').forEach(input => input.value = '');
    table.appendChild(newRow);
  });

  document.getElementById('product-table').addEventListener('click', function(e) {
    if (e.target.classList.contains('remove-row')) {
      const row = e.target.closest('tr');
      if (document.querySelectorAll('#product-table tbody tr').length > 1) {
        row.remove();
      }
    }
  });
</script>

<?php include_once('layouts/footer.php'); ?>
