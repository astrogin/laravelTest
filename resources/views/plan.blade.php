@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if(!isset($userPlan))
                            <div style="display: inline-block; color: red;">
                                Buy some plan!
                            </div>
                        @else
                            Plans
                        @endif
                    </div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container">
                            @foreach($plans as $plan)
                                <div style="margin-left: 50px">
                                    @if(isset($userPlan) && $plan->name === $userPlan->name)
                                        <div style="display: inline-block; color: red;">
                                            Your plan : {{$plan->name}}
                                        </div>
                                    @elseif (isset($planId) && $plan->id === $planId)
                                        <div style="display: inline-block; color: limegreen;">
                                            This plan now processing : {{$plan->name}}
                                        </div>
                                    @else
                                        <div style="display: inline-block;">
                                            {{$plan->name}}
                                        </div>
                                        <button class="pay" onclick="pay(this)" value="{{$plan->id}}">Pay
                                            ${{$plan->price}}</button>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form class="forms" id="checkout" method="post" action="{{route('pay')}}">
        <div id="payment-form"></div>
        <input type="hidden" name="type" id="type" value="">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type="submit" id="pay" style="display: none">Pay</button>
    </form>

    <script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>
    <script>
        function pay(button) {
            var anotherForm = document.getElementById('braintree-dropin-frame');
            if (anotherForm) {
                anotherForm.remove();
            }
            var clientToken = "{{$token}}";
            var el = document.getElementById('pay');
            var hidden = document.getElementById('type');
            hidden.value = button.value;
            el.style.display = 'block';

            braintree.setup(clientToken, "dropin", {
                container: "payment-form"
            });
        }
    </script>
@endsection
