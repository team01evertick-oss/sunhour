@extends('layouts.app')

@section('content')
<div class="ev-wrapper">

    {{-- ── Header ── --}}
    <div class="ev-header">
        <div class="ev-header__left">
            <span class="ev-header__eyebrow">Management</span>
            <h1 class="ev-header__title">Events</h1>
        </div>
        <button class="ev-btn ev-btn--primary" data-modal="create-event">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            New Event
        </button>
    </div>

    {{-- ── Flash ── --}}
    @if(session('success'))
        <div class="ev-alert ev-alert--success">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- ── Stats Bar ── --}}
    <div class="ev-stats">
        <div class="ev-stat">
            <span class="ev-stat__value">{{ $events->count() }}</span>
            <span class="ev-stat__label">Total Events</span>
        </div>
        <div class="ev-stat">
            <span class="ev-stat__value">{{ $events->where('status', 1)->count() }}</span>
            <span class="ev-stat__label">Active</span>
        </div>
        <div class="ev-stat">
            <span class="ev-stat__value">{{ $events->where('status', 0)->count() }}</span>
            <span class="ev-stat__label">Inactive</span>
        </div>
    </div>

    {{-- ── Table Card ── --}}
    <div class="ev-card">
        @if($events->isEmpty())
            <div class="ev-empty">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <p>No events found. Create your first event.</p>
            </div>
        @else
            <div class="ev-table-wrap">
                <table class="ev-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Badge</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Availability</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($events as $index => $event)
                        <tr class="ev-table__row" style="animation-delay: {{ $index * 40 }}ms">
                            <td class="ev-table__num">{{ $index + 1 }}</td>
                            <td>
                                @if($event->image)
                                    <img src="{{ asset('storage/' . $event->image) }}"
                                         alt="{{ $event->title }}"
                                         class="ev-thumb">
                                @else
                                    <div class="ev-thumb ev-thumb--empty">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="ev-name">
                                    <div class="ev-name__dot" style="background: hsl({{ abs(crc32($event->title ?? '')) % 360 }}, 65%, 55%)"></div>
                                    <span class="ev-name__text">{{ $event->title ?? '—' }}</span>
                                </div>
                            </td>
                            <td><span class="ev-pill">{{ $event->badge ?? '—' }}</span></td>
                            <td class="ev-table__muted">{{ $event->brand ?? '—' }}</td>
                            <td class="ev-table__muted">{{ $event->category ?? '—' }}</td>
                            <td class="ev-table__muted">{{ $event->availability ?? '—' }}</td>
                            <td>
                                @if($event->status)
                                    <span class="ev-badge ev-badge--active">Active</span>
                                @else
                                    <span class="ev-badge ev-badge--inactive">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div class="ev-actions">
                                    {{-- Edit button triggers modal with data --}}
                                    <button type="button"
                                        class="ev-icon-btn ev-icon-btn--edit"
                                        title="Edit"
                                        onclick="openEditModal({{ $event->toJson() }})">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </button>

                                    {{-- After --}}
                                    <form action="{{ route('event.destroy', $event->id) }}" method="POST"
                                        onsubmit="return confirm('Delete \'{{ addslashes($event->title) }}\'?')">

                                        @csrf @method('DELETE')
                                        <button type="submit" class="ev-icon-btn ev-icon-btn--delete" title="Delete">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>


    {{-- ════════════════════════════════════════
         CREATE MODAL
    ════════════════════════════════════════ --}}
    <div class="ev-modal" id="modal-create-event" role="dialog" aria-modal="true">
        <div class="ev-modal__backdrop"></div>
        <div class="ev-modal__box">
            <div class="ev-modal__header">
                <h2 class="ev-modal__title">Create New Event</h2>
                <button class="ev-modal__close" data-modal-close>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>

           <form action="{{ route('event.store') }}" method="POST"
      enctype="multipart/form-data" class="ev-form">
                @csrf

                {{-- Tabs --}}
                <div class="ev-tabs">
                    <button type="button" class="ev-tab is-active" data-tab="en">🇬🇧 English</button>
                    <button type="button" class="ev-tab" data-tab="kh">🇰🇭 Khmer</button>
                    <button type="button" class="ev-tab" data-tab="cn">🇨🇳 Chinese</button>
                    <button type="button" class="ev-tab" data-tab="meta">📋 Info</button>
                </div>

                {{-- ENGLISH --}}
                <div class="ev-tab-panel is-active" id="tab-en">
                    <div class="ev-form__group">
                        <label class="ev-form__label">Title <span>*</span></label>
                        <input class="ev-form__input @error('title') is-invalid @enderror"
                               type="text" name="title" value="{{ old('title') }}" placeholder="Event title in English">
                        @error('title')<p class="ev-form__error">{{ $message }}</p>@enderror
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Badge</label>
                        <input class="ev-form__input" type="text" name="badge" value="{{ old('badge') }}" placeholder="e.g. New, Hot, Sale">
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Short Description</label>
                        <textarea class="ev-form__input ev-form__textarea" name="short_description" rows="2" placeholder="Brief summary…">{{ old('short_description') }}</textarea>
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Description</label>
                        <textarea class="ev-form__input ev-form__textarea ev-ck" id="c_description" name="description" rows="4">{{ old('description') }}</textarea>
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Features</label>
                        <textarea class="ev-form__input ev-form__textarea ev-ck" id="c_features" name="features" rows="3">{{ old('features') }}</textarea>
                    </div>
                </div>

                {{-- KHMER --}}
                <div class="ev-tab-panel" id="tab-kh">
                    <div class="ev-form__group">
                        <label class="ev-form__label">Title Khmer</label>
                        <input class="ev-form__input" type="text" name="title_kh" value="{{ old('title_kh') }}" placeholder="ចំណងជើង">
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Badge Khmer</label>
                        <input class="ev-form__input" type="text" name="badge_kh" value="{{ old('badge_kh') }}" placeholder="ស្លាក">
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Short Description Khmer</label>
                        <textarea class="ev-form__input ev-form__textarea" name="short_description_kh" rows="2">{{ old('short_description_kh') }}</textarea>
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Description Khmer</label>
                        <textarea class="ev-form__input ev-form__textarea ev-ck" id="c_description_kh" name="description_kh" rows="4">{{ old('description_kh') }}</textarea>
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Features Khmer</label>
                        <textarea class="ev-form__input ev-form__textarea ev-ck" id="c_features_kh" name="features_kh" rows="3">{{ old('features_kh') }}</textarea>
                    </div>
                </div>

                {{-- CHINESE --}}
                <div class="ev-tab-panel" id="tab-cn">
                    <div class="ev-form__group">
                        <label class="ev-form__label">Title Chinese</label>
                        <input class="ev-form__input" type="text" name="title_cn" value="{{ old('title_cn') }}" placeholder="活动标题">
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Badge Chinese</label>
                        <input class="ev-form__input" type="text" name="badge_cn" value="{{ old('badge_cn') }}" placeholder="徽章">
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Short Description Chinese</label>
                        <textarea class="ev-form__input ev-form__textarea" name="short_description_cn" rows="2">{{ old('short_description_cn') }}</textarea>
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Description Chinese</label>
                        <textarea class="ev-form__input ev-form__textarea ev-ck" id="c_description_cn" name="description_cn" rows="4">{{ old('description_cn') }}</textarea>
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Features Chinese</label>
                        <textarea class="ev-form__input ev-form__textarea ev-ck" id="c_features_cn" name="features_cn" rows="3">{{ old('features_cn') }}</textarea>
                    </div>
                </div>

                {{-- META / INFO --}}
                <div class="ev-tab-panel" id="tab-meta">
                    <div class="ev-form__group">
                        <label class="ev-form__label">Image</label>
                        <input class="ev-form__input ev-form__file" type="file" name="image" accept="image/*">
                    </div>
                    <div class="ev-form__grid">
                        <div class="ev-form__group">
                            <label class="ev-form__label">Brand</label>
                            <input class="ev-form__input" type="text" name="brand" value="{{ old('brand') }}" placeholder="Brand name">
                        </div>
                        <div class="ev-form__group">
                            <label class="ev-form__label">Category</label>
                            <input class="ev-form__input" type="text" name="category" value="{{ old('category') }}" placeholder="Category">
                        </div>
                        <div class="ev-form__group">
                            <label class="ev-form__label">Availability</label>
                            <input class="ev-form__input" type="text" name="availability" value="{{ old('availability') }}" placeholder="e.g. In Stock">
                        </div>
                        <div class="ev-form__group">
                            <label class="ev-form__label">Status</label>
                            <select class="ev-form__input ev-form__select" name="status">
                                <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">CTA Question</label>
                        <input class="ev-form__input" type="text" name="cta_question" value="{{ old('cta_question') }}" placeholder="e.g. Interested?">
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">CTA Title</label>
                        <input class="ev-form__input" type="text" name="cta_title" value="{{ old('cta_title') }}" placeholder="e.g. Contact Us">
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">CTA URL</label>
                        <input class="ev-form__input" type="text" name="cta_url" value="{{ old('cta_url') }}" placeholder="https://...">
                    </div>
                </div>

                <div class="ev-form__footer">
                    <button type="button" class="ev-btn ev-btn--ghost" data-modal-close>Cancel</button>
                    <button type="submit" class="ev-btn ev-btn--primary">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        Save Event
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- ════════════════════════════════════════
         EDIT MODAL
    ════════════════════════════════════════ --}}
    <div class="ev-modal" id="modal-edit-event" role="dialog" aria-modal="true">
        <div class="ev-modal__backdrop"></div>
        <div class="ev-modal__box">
            <div class="ev-modal__header">
                <h2 class="ev-modal__title">Edit Event</h2>
                <button class="ev-modal__close" data-modal-close>
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>

            {{-- ✅ action set dynamically by openEditModal() --}}
                <form id="edit-form" action="" method="POST" enctype="multipart/form-data" class="ev-form">
                @csrf
                @method('PUT') 

                {{-- Tabs --}}
                <div class="ev-tabs">
                    <button type="button" class="ev-tab is-active" data-tab="e_en">🇬🇧 English</button>
                    <button type="button" class="ev-tab" data-tab="e_kh">🇰🇭 Khmer</button>
                    <button type="button" class="ev-tab" data-tab="e_cn">🇨🇳 Chinese</button>
                    <button type="button" class="ev-tab" data-tab="e_meta">📋 Info</button>
                </div>

                {{-- ENGLISH --}}
                <div class="ev-tab-panel is-active" id="tab-e_en">
                    <div class="ev-form__group">
                        <label class="ev-form__label">Title <span>*</span></label>
                        <input class="ev-form__input" type="text" name="title" id="e_title" placeholder="Event title in English">
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Badge</label>
                        <input class="ev-form__input" type="text" name="badge" id="e_badge">
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Short Description</label>
                        <textarea class="ev-form__input ev-form__textarea" name="short_description" id="e_short_description" rows="2"></textarea>
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Description</label>
                        <textarea class="ev-form__input ev-form__textarea" id="e_description" name="description" rows="4"></textarea>
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Features</label>
                        <textarea class="ev-form__input ev-form__textarea" id="e_features" name="features" rows="3"></textarea>
                    </div>
                </div>

                {{-- KHMER --}}
                <div class="ev-tab-panel" id="tab-e_kh">
                    <div class="ev-form__group">
                        <label class="ev-form__label">Title Khmer</label>
                        <input class="ev-form__input" type="text" name="title_kh" id="e_title_kh">
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Badge Khmer</label>
                        <input class="ev-form__input" type="text" name="badge_kh" id="e_badge_kh">
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Short Description Khmer</label>
                        <textarea class="ev-form__input ev-form__textarea" name="short_description_kh" id="e_short_description_kh" rows="2"></textarea>
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Description Khmer</label>
                        <textarea class="ev-form__input ev-form__textarea" id="e_description_kh" name="description_kh" rows="4"></textarea>
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Features Khmer</label>
                        <textarea class="ev-form__input ev-form__textarea" id="e_features_kh" name="features_kh" rows="3"></textarea>
                    </div>
                </div>

                {{-- CHINESE --}}
                <div class="ev-tab-panel" id="tab-e_cn">
                    <div class="ev-form__group">
                        <label class="ev-form__label">Title Chinese</label>
                        <input class="ev-form__input" type="text" name="title_cn" id="e_title_cn">
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Badge Chinese</label>
                        <input class="ev-form__input" type="text" name="badge_cn" id="e_badge_cn">
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Short Description Chinese</label>
                        <textarea class="ev-form__input ev-form__textarea" name="short_description_cn" id="e_short_description_cn" rows="2"></textarea>
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Description Chinese</label>
                        <textarea class="ev-form__input ev-form__textarea" id="e_description_cn" name="description_cn" rows="4"></textarea>
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">Features Chinese</label>
                        <textarea class="ev-form__input ev-form__textarea" id="e_features_cn" name="features_cn" rows="3"></textarea>
                    </div>
                </div>

                {{-- META --}}
                <div class="ev-tab-panel" id="tab-e_meta">
                    <div class="ev-form__group">
                        <label class="ev-form__label">Replace Image</label>
                        <div id="e_current_image" class="ev-current-image"></div>
                        <input class="ev-form__input ev-form__file" type="file" name="image" accept="image/*">
                    </div>
                    <div class="ev-form__grid">
                        <div class="ev-form__group">
                            <label class="ev-form__label">Brand</label>
                            <input class="ev-form__input" type="text" name="brand" id="e_brand">
                        </div>
                        <div class="ev-form__group">
                            <label class="ev-form__label">Category</label>
                            <input class="ev-form__input" type="text" name="category" id="e_category">
                        </div>
                        <div class="ev-form__group">
                            <label class="ev-form__label">Availability</label>
                            <input class="ev-form__input" type="text" name="availability" id="e_availability">
                        </div>
                        <div class="ev-form__group">
                            <label class="ev-form__label">Status</label>
                            <select class="ev-form__input ev-form__select" name="status" id="e_status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">CTA Question</label>
                        <input class="ev-form__input" type="text" name="cta_question" id="e_cta_question">
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">CTA Title</label>
                        <input class="ev-form__input" type="text" name="cta_title" id="e_cta_title">
                    </div>
                    <div class="ev-form__group">
                        <label class="ev-form__label">CTA URL</label>
                        <input class="ev-form__input" type="text" name="cta_url" id="e_cta_url">
                    </div>
                </div>

                <div class="ev-form__footer">
                    <button type="button" class="ev-btn ev-btn--ghost" data-modal-close>Cancel</button>
                    <button type="submit" class="ev-btn ev-btn--primary">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                        Update Event
                    </button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.ev-wrapper -->


{{-- ════════════════ STYLES ════════════════ --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;500;600;700&family=DM+Sans:wght@300;400;500&display=swap');

:root {
    --ev-bg:      #0d0f14;
    --ev-surface: #14171f;
    --ev-border:  #1e2330;
    --ev-accent:  #e8c468;
    --ev-accent2: #5b8af0;
    --ev-text:    #e8eaf0;
    --ev-muted:   #6b7280;
    --ev-danger:  #f05b5b;
    --ev-success: #4caf86;
    --ev-radius:  12px;
    --ev-font-h:  'Syne', sans-serif;
    --ev-font-b:  'DM Sans', sans-serif;
}
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

.ev-wrapper {
    font-family: var(--ev-font-b);
    background: var(--ev-bg);
    min-height: 100vh;
    padding: 2.5rem 2rem;
    color: var(--ev-text);
}

/* Header */
.ev-header { display:flex; align-items:flex-end; justify-content:space-between; margin-bottom:2rem; }
.ev-header__eyebrow { font-family:var(--ev-font-h); font-size:.7rem; letter-spacing:.18em; text-transform:uppercase; color:var(--ev-accent); display:block; margin-bottom:.25rem; }
.ev-header__title   { font-family:var(--ev-font-h); font-size:2rem; font-weight:700; letter-spacing:-.02em; }

/* Alert */
.ev-alert { display:flex; align-items:center; gap:.6rem; padding:.8rem 1.2rem; border-radius:var(--ev-radius); font-size:.875rem; margin-bottom:1.5rem; }
.ev-alert--success { background:rgba(76,175,134,.12); border:1px solid rgba(76,175,134,.3); color:var(--ev-success); }

/* Stats */
.ev-stats { display:flex; gap:1rem; margin-bottom:1.75rem; }
.ev-stat  { flex:1; background:var(--ev-surface); border:1px solid var(--ev-border); border-radius:var(--ev-radius); padding:1.1rem 1.4rem; display:flex; flex-direction:column; gap:.25rem; }
.ev-stat__value { font-family:var(--ev-font-h); font-size:1.75rem; font-weight:700; color:var(--ev-accent); line-height:1; }
.ev-stat__label { font-size:.75rem; color:var(--ev-muted); letter-spacing:.06em; text-transform:uppercase; }

/* Card */
.ev-card { background:var(--ev-surface); border:1px solid var(--ev-border); border-radius:var(--ev-radius); overflow:hidden; }

/* Empty */
.ev-empty { display:flex; flex-direction:column; align-items:center; justify-content:center; gap:1rem; padding:5rem 2rem; color:var(--ev-muted); font-size:.9rem; }

/* Table */
.ev-table-wrap { overflow-x:auto; }
.ev-table { width:100%; border-collapse:collapse; font-size:.875rem; }
.ev-table thead tr { border-bottom:1px solid var(--ev-border); }
.ev-table thead th { font-family:var(--ev-font-h); font-size:.7rem; font-weight:600; letter-spacing:.1em; text-transform:uppercase; color:var(--ev-muted); padding:1rem 1.25rem; text-align:left; white-space:nowrap; }
.ev-table__row { border-bottom:1px solid var(--ev-border); opacity:0; animation:rowIn .35s ease forwards; transition:background .15s; }
.ev-table__row:last-child { border-bottom:none; }
.ev-table__row:hover { background:rgba(255,255,255,.025); }
.ev-table td { padding:.85rem 1.25rem; vertical-align:middle; }
.ev-table__num  { color:var(--ev-muted); font-size:.8rem; }
.ev-table__muted { color:var(--ev-muted); }
@keyframes rowIn { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:translateY(0); } }

/* Thumb */
.ev-thumb { width:44px; height:44px; object-fit:cover; border-radius:8px; border:1px solid var(--ev-border); }
.ev-thumb--empty { display:flex; align-items:center; justify-content:center; background:var(--ev-bg); color:var(--ev-muted); }

/* Name */
.ev-name { display:flex; align-items:center; gap:.6rem; }
.ev-name__dot { width:8px; height:8px; border-radius:50%; flex-shrink:0; }
.ev-name__text { font-weight:500; }

/* Pill */
.ev-pill { display:inline-block; padding:.15rem .6rem; background:rgba(232,196,104,.1); border:1px solid rgba(232,196,104,.25); border-radius:999px; font-size:.72rem; color:var(--ev-accent); }

/* Badges */
.ev-badge { display:inline-flex; align-items:center; padding:.22rem .7rem; border-radius:999px; font-size:.72rem; font-weight:600; letter-spacing:.04em; text-transform:uppercase; }
.ev-badge--active   { background:rgba(76,175,134,.15); color:var(--ev-success); }
.ev-badge--inactive { background:rgba(107,114,128,.12); color:var(--ev-muted); }

/* Actions */
.ev-actions { display:flex; gap:.4rem; align-items:center; }
.ev-icon-btn { display:inline-flex; align-items:center; justify-content:center; width:30px; height:30px; border-radius:8px; border:1px solid var(--ev-border); background:transparent; cursor:pointer; color:var(--ev-muted); transition:all .15s; text-decoration:none; }
.ev-icon-btn--edit:hover   { border-color:var(--ev-accent2); color:var(--ev-accent2); background:rgba(91,138,240,.1); }
.ev-icon-btn--delete:hover { border-color:var(--ev-danger);  color:var(--ev-danger);  background:rgba(240,91,91,.1); }

/* Buttons */
.ev-btn { display:inline-flex; align-items:center; gap:.5rem; padding:.6rem 1.2rem; border-radius:9px; font-family:var(--ev-font-b); font-size:.875rem; font-weight:500; cursor:pointer; transition:all .15s; border:none; }
.ev-btn--primary { background:var(--ev-accent); color:#0d0f14; }
.ev-btn--primary:hover { background:#f0d080; }
.ev-btn--ghost { background:transparent; border:1px solid var(--ev-border); color:var(--ev-muted); }
.ev-btn--ghost:hover { border-color:var(--ev-text); color:var(--ev-text); }

/* Modal */
.ev-modal { display:none; position:fixed; inset:0; z-index:100; align-items:center; justify-content:center; }
.ev-modal.is-open { display:flex; }
.ev-modal__backdrop { position:absolute; inset:0; background:rgba(0,0,0,.65); backdrop-filter:blur(4px); }
.ev-modal__box { position:relative; z-index:1; background:var(--ev-surface); border:1px solid var(--ev-border); border-radius:16px; width:100%; max-width:640px; max-height:90vh; overflow-y:auto; animation:modalIn .2s ease; }
@keyframes modalIn { from { opacity:0; transform:translateY(16px) scale(.97); } to { opacity:1; transform:translateY(0) scale(1); } }
.ev-modal__header { display:flex; align-items:center; justify-content:space-between; padding:1.5rem 1.75rem 1rem; border-bottom:1px solid var(--ev-border); position:sticky; top:0; background:var(--ev-surface); z-index:1; }
.ev-modal__title { font-family:var(--ev-font-h); font-size:1.15rem; font-weight:600; }
.ev-modal__close { display:inline-flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:8px; border:1px solid var(--ev-border); background:transparent; cursor:pointer; color:var(--ev-muted); transition:all .15s; }
.ev-modal__close:hover { color:var(--ev-text); border-color:var(--ev-text); }

/* Tabs */
.ev-tabs { display:flex; gap:.3rem; padding:1rem 1.75rem .5rem; border-bottom:1px solid var(--ev-border); flex-wrap:wrap; }
.ev-tab { padding:.4rem .9rem; border-radius:8px; border:1px solid transparent; background:transparent; cursor:pointer; font-family:var(--ev-font-b); font-size:.82rem; color:var(--ev-muted); transition:all .15s; }
.ev-tab:hover { color:var(--ev-text); }
.ev-tab.is-active { background:rgba(232,196,104,.12); border-color:rgba(232,196,104,.3); color:var(--ev-accent); }

/* Tab panels */
.ev-tab-panel { display:none; padding:1.25rem 1.75rem; flex-direction:column; gap:1rem; }
.ev-tab-panel.is-active { display:flex; }

/* Form */
.ev-form__group { display:flex; flex-direction:column; gap:.45rem; }
.ev-form__grid  { display:grid; grid-template-columns:1fr 1fr; gap:1rem; }
.ev-form__label { font-size:.8rem; font-weight:500; color:var(--ev-muted); letter-spacing:.04em; }
.ev-form__label span { color:var(--ev-accent); }
.ev-form__input { background:var(--ev-bg); border:1px solid var(--ev-border); border-radius:9px; padding:.65rem .9rem; color:var(--ev-text); font-family:var(--ev-font-b); font-size:.875rem; transition:border-color .15s; outline:none; width:100%; }
.ev-form__input:focus { border-color:var(--ev-accent2); }
.ev-form__input.is-invalid { border-color:var(--ev-danger); }
.ev-form__input::placeholder { color:var(--ev-muted); }
.ev-form__textarea { resize:vertical; min-height:80px; }
.ev-form__select  { appearance:none; cursor:pointer; }
.ev-form__file    { padding:.5rem .9rem; cursor:pointer; }
.ev-form__error   { font-size:.78rem; color:var(--ev-danger); }
.ev-form__footer  { display:flex; justify-content:flex-end; gap:.75rem; padding:1rem 1.75rem; border-top:1px solid var(--ev-border); position:sticky; bottom:0; background:var(--ev-surface); }

/* Current image preview */
.ev-current-image img { width:80px; height:80px; object-fit:cover; border-radius:8px; border:1px solid var(--ev-border); margin-bottom:.5rem; display:block; }

/* CKEditor dark override */
.ck.ck-editor__main > .ck-editor__editable { background:var(--ev-bg) !important; color:var(--ev-text) !important; border-color:var(--ev-border) !important; min-height:120px; }
.ck.ck-toolbar { background:var(--ev-surface) !important; border-color:var(--ev-border) !important; }
.ck.ck-button { color:var(--ev-muted) !important; }
.ck.ck-button:hover { background:var(--ev-border) !important; }

/* Responsive */
@media (max-width:640px) {
    .ev-wrapper { padding:1.5rem 1rem; }
    .ev-stats { flex-direction:column; }
    .ev-form__grid { grid-template-columns:1fr; }
    .ev-tabs { gap:.2rem; }
}
</style>


{{-- ════════════════ CKEditor ════════════════ --}}
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

{{-- ════════════════ JS ════════════════ --}}
<script>
// Global editors map for CKEditor instances
const editors = {};

document.addEventListener('DOMContentLoaded', () => {

    function initCK(id) {
        if (editors[id]) return;
        const el = document.getElementById(id);
        if (!el) return;
        ClassicEditor.create(el).then(ed => { editors[id] = ed; }).catch(console.error);
    }

    function setCKData(id, data) {
        if (editors[id]) {
            editors[id].setData(data || '');
        } else {
            // Editor not yet initialised — set raw textarea value as fallback
            const el = document.getElementById(id);
            if (el) el.value = data || '';
        }
    }

    /* ── Init CK editors for CREATE modal ── */
    ['c_description','c_description_kh','c_description_cn',
     'c_features','c_features_kh','c_features_cn'].forEach(initCK);

    /* ── Init CK editors for EDIT modal ── */
    ['e_description','e_description_kh','e_description_cn',
     'e_features','e_features_kh','e_features_cn'].forEach(initCK);


    /* ── Tab switching ── */
    document.querySelectorAll('.ev-tabs').forEach(tabGroup => {
        tabGroup.querySelectorAll('.ev-tab').forEach(tab => {
            tab.addEventListener('click', () => {
                const panel = tab.dataset.tab;
                // Deactivate siblings
                tabGroup.querySelectorAll('.ev-tab').forEach(t => t.classList.remove('is-active'));
                tab.classList.add('is-active');
                // Find nearest form and switch panels inside it
                const form = tabGroup.closest('form') || tabGroup.closest('.ev-modal__box');
                form.querySelectorAll('.ev-tab-panel').forEach(p => p.classList.remove('is-active'));
                const target = document.getElementById('tab-' + panel);
                if (target) target.classList.add('is-active');
            });
        });
    });


    /* ── Generic modal open (data-modal) ── */
    document.querySelectorAll('[data-modal]').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('modal-' + btn.dataset.modal)?.classList.add('is-open');
        });
    });

    /* ── Generic modal close ── */
    document.querySelectorAll('[data-modal-close]').forEach(btn => {
        btn.addEventListener('click', () => {
            btn.closest('.ev-modal')?.classList.remove('is-open');
        });
    });

    document.querySelectorAll('.ev-modal__backdrop').forEach(bd => {
        bd.addEventListener('click', () => bd.closest('.ev-modal')?.classList.remove('is-open'));
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape')
            document.querySelectorAll('.ev-modal.is-open').forEach(m => m.classList.remove('is-open'));
    });


    /* ── Re-open CREATE modal on validation error ── */
    @if($errors->any())
        document.getElementById('modal-create-event')?.classList.add('is-open');
    @endif

});


/* ── openEditModal() — called from each row's edit button ── */
function openEditModal(event) {
    // Set form action
    const form = document.getElementById('edit-form');
        form.action = '/admin/event/' + event.id;

    // English
    document.getElementById('e_title').value            = event.title            || '';
    document.getElementById('e_badge').value            = event.badge            || '';
    document.getElementById('e_short_description').value = event.short_description || '';
    setCKEditData('e_description', event.description    || '');
    setCKEditData('e_features',    event.features        || '');

    // Khmer
    document.getElementById('e_title_kh').value              = event.title_kh              || '';
    document.getElementById('e_badge_kh').value              = event.badge_kh              || '';
    document.getElementById('e_short_description_kh').value  = event.short_description_kh  || '';
    setCKEditData('e_description_kh', event.description_kh   || '');
    setCKEditData('e_features_kh',    event.features_kh       || '');

    // Chinese
    document.getElementById('e_title_cn').value              = event.title_cn              || '';
    document.getElementById('e_badge_cn').value              = event.badge_cn              || '';
    document.getElementById('e_short_description_cn').value  = event.short_description_cn  || '';
    setCKEditData('e_description_cn', event.description_cn   || '');
    setCKEditData('e_features_cn',    event.features_cn       || '');

    // Meta
    document.getElementById('e_brand').value        = event.brand        || '';
    document.getElementById('e_category').value     = event.category     || '';
    document.getElementById('e_availability').value = event.availability || '';
    document.getElementById('e_status').value       = event.status != null ? event.status : 1;
    document.getElementById('e_cta_question').value = event.cta_question || '';
    document.getElementById('e_cta_title').value    = event.cta_title    || '';
    document.getElementById('e_cta_url').value      = event.cta_url      || '';

    // Current image preview
    const imgWrap = document.getElementById('e_current_image');
    imgWrap.innerHTML = event.image
        ? `<img src="/storage/${event.image}" alt="Current image">`
        : '';

    // Reset tabs to first
    document.querySelectorAll('#modal-edit-event .ev-tab').forEach((t,i) => t.classList.toggle('is-active', i === 0));
    document.querySelectorAll('#modal-edit-event .ev-tab-panel').forEach((p,i) => p.classList.toggle('is-active', i === 0));

    // Open modal
    document.getElementById('modal-edit-event').classList.add('is-open');
}

function setCKEditData(id, data) {
    if (editors && editors[id]) {
        editors[id].setData(data);
    } else {
        const el = document.getElementById(id);
        if (el) el.value = data;
    }
}
</script>

@endsection