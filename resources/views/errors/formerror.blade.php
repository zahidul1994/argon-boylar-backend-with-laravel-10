												
												
@if ($errors->any())


											
											<div class="card-alert card green">
                                                    <div class="card-content white-text">
                                                        <span class="card-title white-text darken-1">
                                                            <i class="material-icons">notifications</i> {{count($errors)}} Errors</span>
                                                        <p> @foreach ($errors->all() as $error)
                                                <div class="card-alert card red">
                                                    <div class="card-content white-text">
													
                
                                                       <p>{{ $error }}</p>
                                                     
                                                    </div>
                                                    <button type="button" class="close cyan-text" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                 @endforeach</p>
                                                    </div>
                                                   
                                                    <button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
@endif


