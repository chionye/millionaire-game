<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered" role="document">
		<div class="modal-content load">
			<div class="modal-header">
				<h5 class="modal-title title-text" id="exampleModalLongTitle">Choose a Subcription Amount</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="amountSelection">
					<div class="form-row align-items-center">
						<div class="col-auto my-1">
							<div class="form-check">
							    <input type="hidden" name="phone" value="<?=$user->cout_phone?>" id="phone">
								<input type="hidden" name="email" value="<?=$user->cout_email?>" id="email">
								<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="100" checked>
								<label class="form-check-label title-text" for="gridRadios1">
									100
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="500">
								<label class="form-check-label title-text" for="gridRadios2">
									500
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="1000">
								<label class="form-check-label title-text" for="gridRadios3">
									1000
								</label>
							</div>
							<div class="form-check">
								<input class="form-check-input" type="radio" name="gridRadios" id="gridRadios4" value="2000">
								<label class="form-check-label title-text" for="gridRadios4">
									2000
								</label>
							</div>
						</div>
					</div>
					</form>
				</div>
			<div class="modal-footer">
				<a href="javascript:void" data-dismiss="modal"><img src="images/cls.png" width="50px"></a>
				<a href="javascript:void" onclick="payWithPaystack()"><img src="images/suc.png" width="50px"></a>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModalLongInstructions" role="dialog" aria-labelledby="exampleModalLongTitle22">
	<div class="modal-dialog  modal-dialog-centered" role="document">
		<div class="modal-content load">
			<div class="modal-header">
				<h5 class="modal-title title-text" id="exampleModalLongTitle22">Instructions</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" style="height:800px;overflow:scroll">
				<?php $sql = $db->query("select terms_type from admin where cId = '1'")->fetch_assoc(); 
				    $msg = $sql['terms_type'];
				?>
				<p class="title-text text-dark" style="color:black;"><?=$msg?></p>
		</div>
	</div>
</div>
</div>

<div class="modal fade" id="exampleModalLongComprehension" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle5" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered" role="document">
		<div class="modal-content load">
			<div class="modal-header">
				<h5 class="modal-title title-text" id="exampleModalLongTitle5">Todays Comprehension</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php $sql = $db->query("select prepaid_terms from admin where cId = '1'")->fetch_assoc(); ?>
				<p class="title-text text-dark"><?=$sql['prepaid_terms']?></p>
		</div>
	</div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalLongInstructions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongInstructionTitle" aria-hidden="true">
	<div class="modal-dialog  modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title title-text" id="exampleModalLongInstructionTitle">Results</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row p-3">
                <div class="col-md-8 offset-md-2">
                  <div class="row">
                    <div class="col-md-12">
                    <table class="table table-striped text-center">
                      <thead>
                        <tr>
                          <th scope="col">
                              <img src="images/profile.png" class="img-thumbnail rounded-circle">
                          </th>
                          <th scope="col">
                              <img src="images/profile.png" class="img-thumbnail rounded-circle">
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row" class="p1Name">P1</th>
                          <th class="p2Name">P2</th>
                        </tr>
                        <tr>
                         <th scope="row" class="p1Score">Score: 6</th>
                          <th class="p2Score">Score: 7</th>
                        </tr>
                        <tr>
                          <th scope="row" class="p1Time">Time 00:20</th>
                          <th class="p2Time">Time 00:30</th>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                  <div class="col-md-12 text-center">
                      <button class="btn btn-outline-primary replay ml-1 mr-1">Replay</button>
                  </div>
                </div>
              	</div>
              </div>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title title-text" id="exampleModalLongTitle">Results</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center">
              <div class="row p-3">
                <div class="col-md-8 offset-md-2">
                  <div class="row">
                    <div class="col-md-12">
                    <table class="table table-striped text-center">
                      <thead>
                        <tr>
                          <th scope="col">
                              <img src="images/profile.png" class="img-thumbnail rounded-circle">
                          </th>
                          <th scope="col">
                              <img src="images/profile.png" class="img-thumbnail rounded-circle">
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="row">P1</th>
                          <th>P2</th>
                        </tr>
                        <tr>
                         <th scope="row">Score: 6</th>
                          <th>Score: 7</th>
                        </tr>
                        <tr>
                          <th scope="row">Time 00:20</th>
                          <th>Time 00:30</th>
                        </tr>
                      </tbody>
                    </table>
                    </div>
                      <div class="col-md-12 text-center">
                          <button class="btn btn-outline-primary replay ml-1 mr-1"  id="">Replay</button>
                      </div>
                  </div>
              </div>
              </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalLongChat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongChat1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title title-text" id="exampleModalLongChat1">Chat Opponent</h5>
      </div>
      <div class="modal-body">
         <!-- Outer Row -->
 		  <div class="card o-hidden border-0 p-1">
          <div class="card-body p-0">
            <div class="container">
        	<div class="row">
            <div class="col-sm-12 frame">
            <ul class="msgbars"></ul>
            <div>
                <div class="msj-rta macro">                        
                    <div class="text text-r" style="background:whitesmoke !important">
                        <input class="mytext" placeholder="Type a message"/>
                    </div> 
                </div>
                <div>
                    <button class="sendBtn btn btn-outline-primary mt-2"><i class="fa fa-paper-plane"></i></button>
                </div>                   
            	</div>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <a href="javascript:void" class="endChat"><img src="images/cls.png" width="50px"></a>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="x/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="x/vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="x/js/sb-admin-2.min.js"></script>
<script src="js/wow.min.js"></script>
<script>
	new WOW().init();
</script>
<script src="https://api.ravepay.co/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script><!--<script src="https://js.paystack.co/v1/inline.js"></script>-->
<script src="js/game.js"></script>
<script src="js/dili.js"></script>
<script type="text/javascript">
	
</script>
</body>
</html>
