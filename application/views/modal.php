  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModal">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table table-striped">
        <tbody>
            <?php
                if(isset($marks) && is_array($marks) && count($marks)): $i=1;
                foreach ($marks as $key => $data) { 
                ?>
            <tr>
              <td>Name</td>
              <td><?php echo $data['nama_project']; ?></td>
            </tr>
            <tr>
              <td>Language</td>
              <td><?php echo $data['tenor']; ?></td>
            </tr>
            
            
          <?php 
            }
            endif;   
        ?>
        </tbody>
    </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
