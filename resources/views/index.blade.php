<x-bkash::layouts.app>
    <div class="mx-auto max-w-screen-xl space-y-6 py-12">
        <x-bkash::summary-card :total="$total" :total-transactions="$totalTransactions" :period="$period"/>

        <x-bkash::summary-chart :sums="$sums" :dates="$dates" :period="$period"/>

        <x-bkash::transaction-table :transactions="$transactions" />
    </div>
</x-bkash::layouts.app>
