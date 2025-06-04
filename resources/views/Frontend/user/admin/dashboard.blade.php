@extends('layouts.admin')

@section('content')
@include('layouts.preloader')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h2 class="fw-bold text-dark mb-1">Tableau de bord</h2>
            <p class="text-muted mb-0">Vue d'ensemble de votre plateforme</p>
        </div>
    </div>

    {{-- Statistiques principales améliorées --}}
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 position-relative overflow-hidden">
                <div class="card-body text-center p-4">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-people-fill fs-2 text-primary"></i>
                    </div>
                    <h5 class="text-muted mb-2 fw-normal">Membres</h5>
                    <h3 class="fw-bold text-primary mb-1">{{ number_format($membersCount) }}</h3>
                    <small class="text-muted">Total des utilisateurs</small>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 bg-primary" style="height: 3px;"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 position-relative overflow-hidden">
                <div class="card-body text-center p-4">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-calendar-event-fill fs-2 text-success"></i>
                    </div>
                    <h5 class="text-muted mb-2 fw-normal">Événements</h5>
                    <h3 class="fw-bold text-success mb-1">{{ number_format($evenementsCount) }}</h3>
                    <small class="text-muted">Événements programmés</small>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 bg-success" style="height: 3px;"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 position-relative overflow-hidden">
                <div class="card-body text-center p-4">
                    <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-file-earmark-post-fill fs-2 text-info"></i>
                    </div>
                    <h5 class="text-muted mb-2 fw-normal">Publications</h5>
                    <h3 class="fw-bold text-info mb-1">{{ number_format($postsCount) }}</h3>
                    <small class="text-muted">Articles publiés</small>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 bg-info" style="height: 3px;"></div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100 position-relative overflow-hidden">
                <div class="card-body text-center p-4">
                    <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="bi bi-chat-dots-fill fs-2 text-warning"></i>
                    </div>
                    <h5 class="text-muted mb-2 fw-normal">Commentaires</h5>
                    <h3 class="fw-bold text-warning mb-1">{{ number_format($commentairesCount) }}</h3>
                    <small class="text-muted">Interactions totales</small>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 bg-warning" style="height: 3px;"></div>
            </div>
        </div>
    </div>

    {{-- Graphique de répartition du contenu --}}
    <div class="row g-4 mb-5">
        <div class="col-lg-4 mx-auto">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="fw-bold mb-0 text-center">
                        <i class="bi bi-pie-chart me-2 text-success"></i> Répartition du contenu
                    </h6>
                </div>
                <div class="card-body">
                    <canvas id="contentChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Membres & Commentaires récents améliorés --}}
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0">
                        <i class="bi bi-person-plus-fill me-2 text-primary"></i> Membres récents
                    </h6>
                    <a href="{{ route('visualiser_adherants') }}" class="text-decoration-none small">Voir tous</a>
                </div>
                <div class="card-body p-0">
                    @forelse($recentMembers as $member)
    <div class="d-flex justify-content-between align-items-center p-3 border-bottom border-light">
        <div class="d-flex align-items-center">
            {{-- PHOTO DU MEMBRE --}}
            <img src="{{ $member->photo ? asset('storage/' . $member->photo) : asset('storage/photos/default-user.png') }}"
                 alt="photo"
                 class="rounded-circle me-3"
                 style="width: 40px; height: 40px; object-fit: cover;">

            <div>
                
                <h6 class="mb-1 fw-semibold">{{ $member->name }}</h6>
                <small class="text-muted">{{ $member->email }}</small>
            </div>
        </div>
        <div class="text-end">
            <span class="badge bg-light text-muted">{{ $member->created_at->format('d/m/Y') }}</span>
        </div>
    </div>
@empty
    <div class="text-center py-5">
        <i class="bi bi-person-x text-muted mb-2" style="font-size: 2rem;"></i>
        <p class="text-muted mb-0">Aucun membre récemment inscrit</p>
    </div>
@endforelse

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold mb-0">
                        <i class="bi bi-chat-left-text-fill me-2 text-warning"></i> Commentaires récents
                    </h6>
                    <a href="{{ route('posts.index') }}" class="text-decoration-none small">Gérer</a>
                </div>
                <div class="card-body p-0">
                    @forelse($latestCommentaires as $commentaire)
                        <div class="p-3 border-bottom border-light">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div class="d-flex align-items-center">
                                    <div class="bg-warning bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                                        <i class="bi bi-chat-fill text-warning" style="font-size: 12px;"></i>
                                    </div>
                                    <h6 class="mb-0 fw-semibold">{{ $commentaire->user->name ?? 'Utilisateur inconnu' }}</h6>
                                </div>
                                <small class="text-muted">{{ $commentaire->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="text-muted mb-0 small">
                                {{ \Illuminate\Support\Str::limit($commentaire->content, 100) }}
                            </p>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="bi bi-chat-x text-muted mb-2" style="font-size: 2rem;"></i>
                            <p class="text-muted mb-0">Aucun commentaire récent</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
        
<div class="col-lg-6">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h6 class="fw-bold mb-0">
                <i class="bi bi-envelope-fill me-2 text-danger"></i> Derniers messages reçus
            </h6>
            <a href="{{ route('admin.messages.msgs') }}" class="text-decoration-none small">Voir tous</a>
        </div>
        <div class="card-body p-0">
            @forelse($latestMessages as $message)
                <div class="p-3 border-bottom border-light">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="d-flex align-items-center">
                            <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px;">
                                <i class="bi bi-envelope-paper-fill text-danger" style="font-size: 12px;"></i>
                            </div>
                            <h6 class="mb-0 fw-semibold">{{ $message->sender->name ?? 'Expéditeur inconnu' }}</h6>
                        </div>
                        <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="text-muted mb-0 small">
                        {{ \Illuminate\Support\Str::limit($message->body, 100) }}
                    </p>
                </div>
            @empty
                <div class="text-center py-5">
                    <i class="bi bi-envelope-open text-muted mb-2" style="font-size: 2rem;"></i>
                    <p class="text-muted mb-0">Aucun message récent</p>
                </div>
            @endforelse
        </div>
    </div>
</div>



    </div>
</div>

{{-- Script pour le graphique en cercle --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Graphique de répartition en cercle
    const contentCtx = document.getElementById('contentChart').getContext('2d');
    new Chart(contentCtx, {
        type: 'doughnut',
        data: {
            labels: ['Publications', 'Événements', 'Commentaires'],
            datasets: [{
                data: [{{ $postsCount }}, {{ $evenementsCount }}, {{ $commentairesCount }}],
                backgroundColor: [
                    'rgba(13, 202, 240, 0.8)',
                    'rgba(25, 135, 84, 0.8)',
                    'rgba(255, 193, 7, 0.8)'
                ],
                borderColor: [
                    'rgb(13, 202, 240)',
                    'rgb(25, 135, 84)',
                    'rgb(255, 193, 7)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        font: {
                            size: 14
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return label + ': ' + value + ' (' + percentage + '%)';
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection