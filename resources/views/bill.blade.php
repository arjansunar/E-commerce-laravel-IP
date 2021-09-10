<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Bill</title>
        <style>
            .my-8{
                margin-top: 2rem/* 32px */;
                margin-bottom: 2rem/* 32px */;
            }

            .mx-auto{
                margin: auto;
            }
            .p-16{
                padding: 4rem;
            }

            .flex{
                display: flex;
            }

            .items-center{
                align-items: center;
            }
            .justify-between {
                justify-content: space-between;
            }
            .mb-8 {
                margin-bottom: 2rem/* 32px */;
            }
            .px-3 {
                padding-left: 0.75rem/* 12px */;
                padding-right: 0.75rem/* 12px */;
            }
            .text-2xl {
                font-size: 1.5rem/* 24px */;
                line-height: 2rem/* 32px */;
            }
            .text-right {
                text-align: right;
            }
            .border {
                border-width: 1px;
            }
            .border-t-2 {
                border-top-width: 2px;
            }

            .border-gray-200 {
                --tw-border-opacity: 1;
                border-color: rgba(229, 231, 235, var(--tw-border-opacity));
            }
            .mb-4 {
                margin-bottom: 1rem/* 16px */;
            }
            .py-2 {
                padding-top: 0.5rem/* 8px */;
                padding-bottom: 0.5rem/* 8px */;
            }

            .font-medium {
                font-weight: 500;
            }
            .leading-none {
                line-height: 1;
            }
            .text-center {
                text-align: center;
            }
            .text-sm {
                font-size: 0.875rem/* 14px */;
                line-height: 1.25rem/* 20px */;
            }
            .bg-gray-200 {
                --tw-bg-opacity: 1;
                background-color: rgba(229, 231, 235, var(--tw-bg-opacity));
            }
        </style>
    </head>
    <body style="font-family: sans-serif">
        <div class="my-8 mx-auto p-16" style="max-width: 800px">
            <div class="flex items-center justify-between mb-8 px-3">
                <div>
                    <span class="text-2xl">Invoice from the formal store</span><br />
                    <span>Date</span>: {{$info["date"]}}<br />
                </div>
                <div class="text-right">
                    <img
                        src="https://www.stenvdb.be/assets/img/email-signature.png"
                    />
                </div>
            </div>
            <div class="flex justify-between mb-8 px-3">
                <div>
                    To, {{$info["name"] ?? ''}}<br />
                    Address: {{$info["address"]}}<br />
                    Phone: {{$info["phone"]}}
                </div>
                <div class="text-right">
                    The Formal Store<br />
                    Street 12<br />
                    10000 City<br />
                    hello@formalstore.com
                </div>
            </div>

            <div class="border border-t-2 border-gray-200 mb-8 px-3"></div>

            <div class="mb-8 px-3">
                <p>
                    Thankyou for your purchase!!
                </p>
            </div>
            @forelse($products as $id=> $value)
                <div class="flex justify-between mb-4 bg-gray-200 px-3 py-2">
                    <div>{{$value->name}}({{$value->quantity}})</div>
                    <div class="text-right font-medium">$ {{$value->quantity * $value->price}}</div>
                </div>
            @empty 
                <div>!No items!</div>
            @endforelse
            <div class="flex justify-between items-center mb-2 mt-2 px-3">
                <div class="text-2xl leading-none">
                    <span class="">Total</span>:
                </div>
                <div class="text-2xl text-right font-medium">$ {{$total}}</div>
            </div>

            

            <div class="my-8 text-4xl text-center px-3">
                <span>Thank you!</span>
            </div>

            <div class="text-center text-sm px-3">
                hello@formalstore.com | www.theformalstore.com
            </div>
        </div>
    </body>
</html>
