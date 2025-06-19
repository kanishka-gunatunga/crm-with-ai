@extends('master')

@section('content')
    <?php
    
    use App\Models\Lead;
    use App\Models\Person;
    ?>


    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <style>
        #sortable {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 60%;
        }

        #sortable li {
            margin: 0 3px 3px 3px;
            padding: 0.4em;
            padding-left: 1.5em;
            font-size: 1.4em;
            height: 18px;
        }

        #sortable li span {
            position: absolute;
            margin-left: -1.3em;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>




    <div class="main-scrollable">
        <div class="page-container">
            <div class="page-title-container">
                <div class="d-flex justify-content-between">
                    <h3 class="page-title">
                        Leads
                    </h3>
                    <div class="d-flex gap-3">
                        <button class="import-leads-button">
                            <div class="icon-container">
                                <!-- SVG omitted for brevity -->
                            </div>
                            <span class="button-text">Import leads</span>
                        </button>
                        <button class="import-leads-button">
                            <div class="icon-container">
                                <!-- SVG omitted for brevity -->
                            </div>
                            <span class="button-text">Export leads</span>
                        </button>
                        <a href="{{ url('create-lead') }}">
                            <button class="import-leads-button">
                                <div class="icon-container">
                                    <!-- SVG omitted for brevity -->
                                </div>
                                <span class="button-text">New lead</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="d-flex card-container gap-1">
                    <?php
                $orderedStages = collect($stages)->sortBy(function ($stage) {
                    if ($stage->name == 'New') {
                        return 1;
                    } elseif ($stage->name == 'Won') {
                        return 9999;
                    } elseif ($stage->name == 'Lost') {
                        return 10000;
                    }
                    return 500;
                })->values();
                foreach ($orderedStages as $stage) {
                    $stage_value = 0;
                    $leads = $leadsGroupedByStage->get($stage->id, collect());
                    $stage_value = $leads->sum('lead_value');
                ?>
                    <div class="col-md-3">
                        <div class="card card-default lead-card ">
                            <div class="card-body">
                                <div class="notification-container my-3">
                                    <article class="notification-card">
                                        <div class="notification-content new w-100">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="notification-label">{{ $stage->name }} </span>
                                                <span class="notification-badge"> 24</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <span class="notification-badge"> ${{ number_format($stage_value) }}</span>
                                            </div>
                                        </div>
                                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/903c68d6b1d1c328194d6567f5964162e88d96a3?placeholderIfAbsent=true&apiKey=58cf9ebae01449cda017611d277ef437"
                                            alt="Notification icon" class="notification-icon" />
                                    </article>
                                </div>
                                <div id="stage-{{ $stage->id }}" data-status="{{ $stage->id }}"
                                    class="task-list connectedSortable">
                                    <?php foreach ($leads as $lead) {
                                        $person_name = Person::where('id', $lead->person)->value('name');
                                    ?>
                                    <article class="task-card" data-lead-id="{{ $lead->id }}"
                                        data-value="{{ $lead->lead_value }}">
                                        <header class="task-header">
                                            <div class="date-section">
                                                <svg class="calendar-icon" width="12" height="12" viewBox="0 0 12 12"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <!-- SVG omitted for brevity -->
                                                </svg>
                                                <time class="due-date">May 26, 2025</time>
                                            </div>
                                            <?php if ($lead->category == 'low') { ?>
                                            <span class="priority-badge low">Low</span>
                                            <?php } elseif ($lead->category == 'medium') { ?>
                                            <span class="priority-badge medium">Medium</span>
                                            <?php } elseif ($lead->category == 'high') { ?>
                                            <span class="priority-badge high">High</span>
                                            <?php } else { ?>
                                            <span class="priority-badge urgent">Urgent</span>
                                            <?php } ?>
                                        </header>
                                        <main class="task-content">
                                            <a href="{{ url('view-lead/' . $lead->id) }}">
                                                <h2 class="task-title">{{ $lead->title }}</h2>
                                            </a>
                                            <p class="company-name">Stop & Shop</p>
                                        </main>
                                        <div class="divider"></div>
                                        <footer class="task-footer">
                                            <div class="assignee-info">
                                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/f003d3c100b2517a9a663b0743b6c252f551c39f?placeholderIfAbsent=true&apiKey=58cf9ebae01449cda017611d277ef437"
                                                    class="avatar" alt="Ronald Richards" />
                                                <a href="{{ url('persons?id=' . $lead->person) }}">
                                                    <span class="assignee-name">{{ $person_name }}</span>
                                                </a>
                                            </div>
                                            <div class="action-buttons">
                                                <button class="action-btn favorite-btn" aria-label="Add to favorites">
                                                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/268cebf93bfa072c8615343d386f71417a021f51?placeholderIfAbsent=true&apiKey=58cf9ebae01449cda017611d277ef437"
                                                        class="action-icon" alt="Favorite" />
                                                </button>
                                                <button class="action-btn more-btn" aria-label="More options">
                                                    <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/912cec917361569cb1ed6faba7bd9c7d04d9247d?placeholderIfAbsent=true&apiKey=58cf9ebae01449cda017611d277ef437"
                                                        class="action-icon" alt="More options" />
                                                </button>
                                            </div>
                                        </footer>
                                    </article>
                                    <?php } ?>
                                </div>
                                <div class="add-card-wrapper">
                                    <a href="{{ url('create-lead') }}">
                                        <div class="add-card-container">
                                            <div class="add-card-button">
                                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/7594641fe0b0bf04f82d99ec52410440ee0f61f1?placeholderIfAbsent=true&apiKey=58cf9ebae01449cda017611d277ef437"
                                                    class="add-card-icon" alt="Add icon" />
                                                <span class="add-card-text">Add Card</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.task-list').forEach(function(stage) {
            new Sortable(stage, {
                group: 'leads', // This allows dragging between lists
                animation: 150,
                onEnd: function(evt) {
                    console.log("Sort ended");

                    // Safety: log evt structure
                    console.log("evt.from:", evt.from);
                    console.log("evt.to:", evt.to);

                    var leadId = evt.item.getAttribute('data-lead-id');
                    var leadValue = parseFloat(evt.item.getAttribute('data-value'));

                    // Safe fallback method to get data-status from parent .task-list
                    var oldStage = evt.from?.getAttribute('data-status');
                    var newStage = evt.to?.getAttribute('data-status');

                    console.log("leadId:", leadId);
                    console.log("leadValue:", leadValue);
                    console.log("oldStage:", oldStage);
                    console.log("newStage:", newStage);

                    // Check if these values exist
                    if (!leadId || !oldStage || !newStage) {
                        console.error("One or more required values are missing");
                        return;
                    }

                    updateLeadStage(leadId, newStage, leadValue, oldStage);
                }

            });
        });
    });


    function updateLeadStage(leadId, newStage, leadValue, oldStage) {
        console.log("leadId:", leadId);
        console.log("newStage:", newStage);
        console.log("leadValue:", leadValue);
        console.log("oldStage:", oldStage);
        var csrfToken = "{{ csrf_token() }}";

        $.ajax({
            url: "{{ url('update-lead-stage') }}",
            method: "POST",
            data: {
                _token: csrfToken,
                lead_id: leadId,
                new_stage_id: newStage
            },
            success: function(response) {
                toastr.success("Lead stage updated successfully");
                var oldStageValueElement = document.getElementById('stage-value-' + oldStage);
                var newStageValueElement = document.getElementById('stage-value-' + newStage);

                var oldStageValue = parseFloat(oldStageValueElement.innerText.replace('$', '').replace(',',
                    ''));
                var newStageValue = parseFloat(newStageValueElement.innerText.replace('$', '').replace(',',
                    ''));

                oldStageValueElement.innerText = "$" + (oldStageValue - leadValue).toLocaleString();
                newStageValueElement.innerText = "$" + (newStageValue + leadValue).toLocaleString();
            },
            error: function(xhr, status, error) {
                // console.error("Error updating lead stage", error);
                toastr.error("Error updating lead stage");
            }
        });
    }
</script>

<script>
    $(document).ready(function() {
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif

        @if (Session::has('fail'))
            toastr.error("{{ Session::get('fail') }}");
        @endif
    });
</script>
