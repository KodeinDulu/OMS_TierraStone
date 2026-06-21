<x-filament-widgets::widget>
<div style="display:flex;flex-direction:column;gap:12px;padding:4px 0">

    {{-- Stat Cards --}}
    <div style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:12px">
        @foreach([
            ['label'=>'Total order', 'value'=>$total,    'color'=>'#6B7280'],
            ['label'=>'Follow up',  'value'=>$follow_up, 'color'=>'#8B5CF6'],
            ['label'=>'Tenggat dekat','value'=>$due_soon,'color'=>'#EF4444'],
            ['label'=>'Siap kirim',  'value'=>$ready,    'color'=>'#10B981'],
        ] as $s)
        <div style="background:#FFFFFF;border:1px solid #E5E7EB;border-radius:var(--border-radius-lg);padding:16px 18px;box-shadow:0 1px 3px rgba(0,0,0,0.1);transition:all 0.2s ease;display:flex;flex-direction:column">
            <div style="font-size:12px;color:#6B7280;margin-bottom:8px;font-weight:500">{{ $s['label'] }}</div>
            <div style="font-size:28px;font-weight:600;color:{{ $s['color'] }};line-height:1">{{ $s['value'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- Main --}}
    <div style="display:grid;grid-template-columns:1fr 220px;gap:12px;align-items:start">

        {{-- Order List --}}
        <div style="background:#FFFFFF;border:1px solid #E5E7EB;border-radius:var(--border-radius-lg);padding:18px;box-shadow:0 1px 3px rgba(0,0,0,0.1)">

            {{-- Header --}}
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px">
                <span style="font-size:14px;font-weight:600;color:#1F2937">Order aktif</span>
                <select wire:model.live="statusFilter"
                    style="font-size:12px;padding:6px 12px;border-radius:6px;border:1px solid #E5E7EB;background:#FFFFFF;color:#1F2937;cursor:pointer;font-weight:500">
                    <option value="">Semua status</option>
                    <option value="follow_up">Follow Up</option>
                    <option value="indent">Indent</option>
                    <option value="production">Production</option>
                    <option value="on_progress">On Progress</option>
                    <option value="ready_to_deliver">Ready to Deliver</option>
                </select>
            </div>

            {{-- Col header --}}
            <div style="display:grid;grid-template-columns:1fr 80px 100px 90px;gap:8px;padding:10px 0 8px 0;border-bottom:1px solid #E5E7EB;margin-bottom:6px">
                <span style="font-size:11px;color:#6B7280;font-weight:600;text-transform:uppercase">Customer / Order ID</span>
                <span style="font-size:11px;color:#6B7280;font-weight:600;text-transform:uppercase;text-align:center">Total Qty</span>
                <span style="font-size:11px;color:#6B7280;font-weight:600;text-transform:uppercase">Status</span>
                <span style="font-size:11px;color:#6B7280;font-weight:600;text-transform:uppercase">Tenggat</span>
            </div>

            @forelse($orders as $order)
                @php
                    $days = $order['days_left'];
                    [$dueText, $dueColor] = match(true) {
                        $days === null => ['Tidak ada tenggat', 'var(--color-text-tertiary)'],
                        $days < 0     => ['Terlambat '.abs((int)$days).'h', 'var(--color-text-danger)'],
                        $days == 0    => ['Hari ini', 'var(--color-text-danger)'],
                        $days <= 3    => [(int)$days.'h lagi', 'var(--color-text-warning)'],
                        default       => [(int)$days.'h lagi', 'var(--color-text-success)'],
                    };
                    [$badgeBg, $badgeColor, $statusLabel] = match($order['status']) {
                        'indent'          => ['#FAEEDA','#633806','Indent'],
                        'production'       => ['#E6F1FB','#0C447C','Production'],
                        'on_progress'      => ['#EEEDFE','#3C3489','On Progress'],
                        'ready_to_deliver' => ['#EAF3DE','#27500A','Ready'],
                        'indent'           => ['#FAEEDA','#633806','Indent'],
                        'on_delivery'      => ['#E6F1FB','#0C447C','On Delivery'],
                        default            => ['#F1EFE8','#444441', ucfirst(str_replace('_',' ',$order['status']))],
                    };
                    $isLate = $days !== null && $days < 0;
                    $rowBg = $isLate ? '#FEE2E2' : '#FFFFFF';
                @endphp
                <div style="display:grid;grid-template-columns:1fr 80px 100px 90px;gap:8px;align-items:center;padding:10px 8px;border-bottom:0.5px solid #E5E7EB;background:{{ $rowBg }};border-radius:6px">
                    <div>
                        <div style="font-size:13px;font-weight:500;color:{{ $isLate ? '#991B1B' : '#1F2937' }};overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $order['customer'] }}</div>
                        <div style="font-size:11px;color:#9CA3AF;margin-top:2px">{{ $order['id'] }}</div>
                    </div>
                    <div style="text-align:center">
                        <span style="font-size:13px;font-weight:600;color:{{ $isLate ? '#DC2626' : '#1F2937' }}">{{ $order['quantity'] }}x</span>
                    </div>
                    <div>
                        <span style="font-size:11px;font-weight:600;padding:4px 10px;border-radius:20px;background:{{ $badgeBg }};color:{{ $badgeColor }};display:inline-block">
                            {{ $statusLabel }}
                        </span>
                    </div>
                    <div style="font-size:12px;color:{{ $dueColor }};font-weight:500">{{ $dueText }}</div>
                </div>
            @empty
                <div style="text-align:center;padding:24px;font-size:13px;color:var(--color-text-tertiary)">Tidak ada order</div>
            @endforelse
        </div>

        {{-- Side --}}
        <div style="display:flex;flex-direction:column;gap:12px">

            {{-- Breakdown --}}
            <div style="background:#FFFFFF;border:1px solid #E5E7EB;border-radius:var(--border-radius-lg);padding:18px;box-shadow:0 1px 3px rgba(0,0,0,0.1)">
                <div style="font-size:14px;font-weight:600;margin-bottom:12px;color:#1F2937">Status breakdown</div>
                @php
                    $statusMap = [
                        'follow_up'       => ['Follow Up',   '#8B5CF6'],
                        'indent'          => ['Indent',     '#BA7517'],
                        'production'       => ['Production',  '#378ADD'],
                        'on_progress'      => ['On Progress', '#7F77DD'],
                        'ready_to_deliver' => ['Ready',       '#639922'],
                        'on_delivery'      => ['On Delivery', '#378ADD'],
                    ];
                @endphp
                @foreach($statusMap as $key => [$label, $color])
                    @if(($status_counts[$key] ?? 0) > 0)
                    <div style="margin-bottom:10px">
                        <div style="display:flex;justify-content:space-between;margin-bottom:4px">
                            <span style="font-size:12px;color:#6B7280;font-weight:500">{{ $label }}</span>
                            <span style="font-size:12px;font-weight:600;color:{{ $color }}">{{ $status_counts[$key] }}</span>
                        </div>
                        <div style="height:6px;background:#F3F4F6;border-radius:3px;overflow:hidden">
                            <div style="height:100%;border-radius:3px;background:{{ $color }};width:{{ $total > 0 ? round($status_counts[$key] / $total * 100) : 0 }}%;transition:width 0.3s ease"></div>
                        </div>
                    </div>
                    @endif
                @endforeach

                @if($status_counts->isEmpty())
                    <div style="font-size:12px;color:#9CA3AF;text-align:center;padding:12px 0">Tidak ada data</div>
                @endif
            </div>

            {{-- Perlu Perhatian --}}
            <div style="background:#FFFFFF;border:1px solid #E5E7EB;border-radius:var(--border-radius-lg);padding:18px;box-shadow:0 1px 3px rgba(0,0,0,0.1)">
                <div style="font-size:14px;font-weight:600;margin-bottom:10px;color:#1F2937">Perlu perhatian</div>
                @if($urgent->isEmpty() && $due_today->isEmpty())
                    <div style="font-size:12px;color:var(--color-text-success);padding:8px 0;display:flex;align-items:center;gap:6px">
                        <span style="font-size:16px">✓</span> Semua order on track
                    </div>
                @else
                    @foreach($urgent as $o)
                    <div style="display:flex;align-items:center;gap:6px;margin-bottom:8px;min-width:0">
                        <span style="flex-shrink:0;font-size:11px;font-weight:600;padding:3px 8px;border-radius:12px;background:#FCEBEB;color:#791F1F;white-space:nowrap">Terlambat</span>
                        <span style="font-size:12px;color:var(--color-text-primary);overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $o['customer'] }}</span>
                    </div>
                    @endforeach
                    @foreach($due_today as $o)
                    <div style="display:flex;align-items:center;gap:6px;margin-bottom:8px;min-width:0">
                        <span style="flex-shrink:0;font-size:11px;font-weight:600;padding:3px 8px;border-radius:12px;background:#FAEEDA;color:#633806;white-space:nowrap">
                            {{ $o['days_left'] == 0 ? 'Hari ini' : (int)$o['days_left'].'h lagi' }}
                        </span>
                        <span style="font-size:12px;color:var(--color-text-primary);overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $o['customer'] }}</span>
                    </div>
                    @endforeach
                @endif
            </div>

        </div>
    </div>
</div>
</x-filament-widgets::widget>
