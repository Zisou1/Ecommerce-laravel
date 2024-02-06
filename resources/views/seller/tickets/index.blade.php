@extends('layouts.seller')
@section('content')


<section class="why_section layout_padding">
    <div class="container">
       <div class="heading_container heading_center">
        <h2>
            Tickets
          </h2>
       </div>
    </div>
</section>

<!-- why section -->
<section class="why_section layout_padding bg-white">
<div class="container">
    <div class="row d-flex justify-content-end">
        <button type="button" data-toggle="modal" data-target=".add-conn" class="btn btn-success mt-2 p-2 mb-4" >Ajouter</button>
    </div>
    <div class="modal fade add-conn" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Ajouter une ticket</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <section class="why_section layout_padding">
                  <div class="container">
                  
                     <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                           <div class="full">
                              <form action="{{route('seller.ticket.store')}}" method="POST">
                               @csrf
                               <div class="modal-body">
                                 <fieldset>
                                    <input type="text" placeholder="Entrez le titre" name="title" required />
                                   <div class=gravity>
                                    <select name="gravity" id="myDropdown" required>
                                      <option value="" disabled selected>Select la gravity </option>
                                      <option value="faible">faible</option>
                                      <option value="normal">normal</option>
                                      <option value="urgent">urgent</option>
                                    </select>
                                  </div>
                                    <textarea placeholder="Enter your message" class="mt-4 mb-2" name="message" required></textarea>
                                 </fieldset>
                               </div>
                               <div class="modal-footer">
                                 {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                                 <button type="submit"  class="btn btn-primary">Enregistrer</button>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
              </div>
        </div>
      </div>
    @if($tickets->isNotEmpty())
    <div id="accordion">
        @foreach($tickets as $key => $ticket)
            <div class="card">
                <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                <div class="card-header " id="heading{{$key}}">
                        <h5 class="mb-0 ">
                            {{$ticket->title}} 
                        </h5>
                </div>
                </button>
            
                <div id="collapse{{$key}}" class="collapse show" aria-labelledby="heading{{$key}}" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row border border-bottom-1">
                            <h5>Titre : </h5>
                            <p id="solution">{{$ticket->message}}</p>
                        </div>
                        <div class="row border border-bottom-1">
                            <label for="lien"></label>
                            <h6 id="lien">Gravitée : {{$ticket->priority}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
      </div>
    @else
        <h2 class="mt-4 p-3 d-flex justify-content-center">
            Pas de resources trouvées
        </h2>
    @endif
</div>
</section>
<!-- end why section -->


@endsection