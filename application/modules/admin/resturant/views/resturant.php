<?php $this->load->view('admin/search');?>
       
  <!--<div class="col-md-12 mt-5 t_div">
      <table class="table b-g">
        <thead>
        <tr>
                <th >Resturant Id</th>
                <th scope="col">Resturant Name</th>
                <th scope="col">Address</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Menu Hours</th>
                <th scope="col">Total branches</th>
        </tr>
        </thead>
        <tbody> 
        <?php foreach($view as $v){?>
            <tr>
                <th class="fonn"><?php echo $v->resturant_id;?><i class="fa fa-clone" aria-hidden="true"></i></th>
                <td><a href="#"><?php echo $v->resturant_name;?></a></td>
                <td><?php echo $v->resturant_area.','.$v->resturant_block.','.$v->resturant_street.','.$v->resturant_jaada.','.$v->resturant_house.','.$v->resturant_building;?></td>
                <td><?php echo $v->resturant_contact_no;?></td>
                <td><?php echo $v->resturant_menu_hours;?></td>
                <td>-</td>
        </tr>
        <?php } ?>
                    
      </tbody>
    </table>
  </div> -->