@extends('layouts.header')

@section('content')
<div id="test">
  <div class="container">
    <div class="row">
        <div class="col-xl-4 col-md-6 col-12 ">
          <div class="box box-body pull-up">
            <div class="flexbox justify-content-start align-items-center">
              <span class="fa fa-money-bill-wave text-danger font-size-50 mr-25"></span>
                <div>
                  <h1 class=" font-size-30">{{Auth::user()->wallet->balance}}</h1>
                  <h6 class="text-uppercase text-fade">Balance</h6>
                </div>
            </div>
          </div>
        </div>
       
        <div class="col-xl-4 col-md-6 col-12 ">
          <div class="box box-body pull-up">
            <div class="flexbox justify-content-start align-items-center">
              <span class="fa fa-phone text-info font-size-50 mr-25"></span>
                <div>
                <h1 class=" font-size-30">@{{transactions.length}}</h1>
                  <h6 class="text-uppercase text-fade">Total Transactions</h6>
                </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-md-6 col-12 ">
            <div class="box box-body pull-up">
              <div class="flexbox justify-content-start align-items-center">
                <span class="fa fa-user text-info font-size-50 mr-25"></span>
                  <div>
                  <h1 class=" font-size-30">{{Auth::user()->referrer_code}}</h1>
                    <h6 class="text-uppercase text-fade">Referral Code</h6>
                  </div>
              </div>
            </div>
          </div>
  </div>
  <section class="content">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-bordered" id="mainTable">
                    <thead>
                        <tr>
                          <th>Reference</th>
                          <th>Description</th>
                          <th>Amount</th>
                          <th>Initial Balance</th>
                          <th>Final Balance</th>
                          <th>Receiver</th>
                          <th>Date</th>
                        </tr>
                      </thead>



                        <tbody>
                         
                        <tr v-for="transaction in transactions" :key="transaction.id">
                          <td>@{{transaction.reference}}</td>
                          <td>@{{transaction.description}}</td>
                          <td>@{{transaction.amount}}</td>
                          <td>@{{transaction.initial_balance}}</td>
                          <td>@{{transaction.final_balance}}</td>
                          <td>@{{transaction.transfer_to}}</td>
                            <td>@{{transaction.created_at}}</td>
                        </tr>
                    </tbody>

                </table>
                
              </div>

        </div>
    </div>
  </section>
  </div>
</div>

<div class="modal" tabindex="-1" id="exampleModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Send Money</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form @submit="sendMoney">
        <div class="form-group">
            <label for="email">Receiver Email</label>
            <input type="email" id="email" v-model="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" id="amount" v-model="amount" class="form-control">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Send</button>
        </div>
    </form>
      </div>
     
    </div>
  </div>
</div>
@endsection
@section('extra-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

<script>
   var app = new Vue ({
            el: "#test",
            data: function () {
                return {
                    email:'',
                    amount: '',
                    transactions: [],
                }
            },
            methods: {
                getTransactions() {
                    axios.get('/transactions')
                     .then((response)=>{
                       this.transactions = response.data.transaction
                     }).catch((err)=>{
                        toastr.warning ("could not fetch transactions");
                     })
                },
                
                sendMoney(e) {
                    e.preventDefault();
                    console.log('yeah')
                    if (this.email == '' || this.amount == '') {
                        toastr.warning("please fill all fields");
                        return;
                    }
                    let data = {
                        email: this.email,
                        amount: this.amount,
                        // _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                       
                    }
                    axios.post('/send-money', data)
                    .then((response) => {
                        console.log(response)
                        if (response.data.message) {
                            toastr.success("Money Sent Successfully!");
                            // $('#exampleModal').modal('hide');
                        }
                    }).catch((error) => {
                        toastr.error(`${error.data.error}`)
                        // $('#exampleModal').modal('hide');
                    })
                }
            },
           
            mounted () {
                console.log("AM HERE!");
                this.getTransactions();
                
            },
           
        })
</script>
@endsection