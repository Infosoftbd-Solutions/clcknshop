<div class="thankyour-area bg-white mb-30 " id="flasharea">
						<div class="row">
							<div class="col-md-12">
								<div class="thankyou">
									<h2 class="text-center mb-0 alert alert-info">{{ message }}</h2>
								</div>


							</div>
						</div>
</div>
<script>

setTimeout(function(){
	document.getElementById("flasharea").classList.add('hidden');

}, 5000);
</script>
