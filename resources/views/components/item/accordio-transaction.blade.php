@props(['transactions'])

<div class="accordion my-5" id="accordionPanelsStayOpenExample">

    <div class="accordion-item">

        <x-item.header data_target="#transaction"> Transaction </x-item.header>

        <x-item.item-data target_id="transaction">

            <div class="table-responsive">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Transaction ID</th>
                            <th scope="col">Type</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Created</th>
                            <th scope="col">Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->id }}</td>        
                                <td><a href="{{ route('transaction.show', $transaction->id) }}">{{ $transaction->type }}</a> </td>
                                <td>£ {{ $transaction->amount }} </td>
                                <td>{{ date('d/m/Y', strtotime($transaction->created_at)) }}</td>
                                <td>{{ date('d/m/Y', strtotime($transaction->updated_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </x-item.item-data>

    </div>
</div>