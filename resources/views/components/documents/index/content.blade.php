@if ($hideEmptyPage)
    @if (! $hideSummary)
    <x-index.summary :items="$summaryItems" />
    @endif

    <x-index.container>
        @if (! $withoutTabs)
            <x-tabs active="{{ $tabActive }}" id="tabs-{{ $type }}">
                <x-slot name="navs">
                    @stack('document_nav_start')

                    @if ($tabActive == $type . '-unpaid')
                        <x-tabs.nav-pin
                            id="{{ $type . '-unpaid' }}"
                            name="{{ trans('documents.statuses.unpaid') }}"
                            type="{{ $type }}"
                            tab="unpaid"
                        />
                    @else
                        <x-tabs.nav-pin
                            id="{{ $type . '-unpaid' }}"
                            href="{{ route($routeTabDocument, $routeParamsTabUnpaid) }}"
                            name="{{ trans('documents.statuses.unpaid') }}"
                            type="{{ $type }}"
                            tab="unpaid"
                        />
                    @endif

                    @if ($tabActive == $type . '-draft')
                        <x-tabs.nav-pin
                            id="{{ $type . '-draft' }}"
                            name="{{ trans('documents.statuses.draft') }}"
                            type="{{ $type }}"
                            tab="draft"
                        />
                    @else
                        <x-tabs.nav-pin
                            id="{{ $type . '-draft' }}"
                            href="{{ route($routeTabDocument, $routeParamsTabDraft) }}"
                            name="{{ trans('documents.statuses.draft') }}"
                            type="{{ $type }}"
                            tab="draft"
                        />
                    @endif

                    @if ($tabActive == $type . '-all')
                        <x-tabs.nav-pin
                            id="{{ $type . '-all' }}"
                            name="{{ trans('general.all_type', ['type' => trans_choice($textTabDocument, 2)]) }}"
                            type="{{ $type }}"
                            tab="all"
                        />
                    @else
                        <x-tabs.nav-pin
                            id="{{ $type . '-all' }}"
                            href="{{ route($routeTabDocument, ['list_records' => 'all']) }}"
                            name="{{ trans('general.all_type', ['type' => trans_choice($textTabDocument, 2)]) }}"
                            type="{{ $type }}"
                            tab="all"
                        />
                    @endif

                    @stack('document_nav_end')

                    @if ($tabActive == 'recurring-templates')
                        @if (! $hideRecurringTemplates)
                            <x-tabs.nav id="recurring-templates" name="{{ trans_choice('general.recurring_templates', 2) }}" active />
                        @endif
                    @else
                        @if (! $hideRecurringTemplates)
                            <x-tabs.nav-link id="recurring-templates" name="{{ trans_choice('general.recurring_templates', 2) }}" href="{{ route($routeTabRecurring) }}" />
                        @endif
                    @endif

                    @stack('recurring_nav_end')
                </x-slot>

                <x-slot name="content">
                    @if ((! $hideSearchString) && (! $hideBulkAction))
                    <x-index.search
                        search-string="{{ $searchStringModel }}"
                        bulk-action="{{ $bulkActionClass }}"
                        route="{{ $searchRoute }}"
                    />
                    @elseif ((! $hideSearchString) && $hideBulkAction)
                    <x-index.search
                        search-string="{{ $searchStringModel }}"
                        route="{{ $searchRoute }}"
                    />
                    @elseif ($hideSearchString && (! $hideBulkAction))
                    <x-index.search
                        bulk-action="{{ $bulkActionClass }}"
                        route="{{ $searchRoute }}"
                    />
                    @endif

                    @stack('document_tab_start')

                    @if ($tabActive != 'recurring-templates')
                        <x-tabs.tab id="{{ $tabActive }}">
                            <x-documents.index.document :type="$type" :documents="$documents" />
                        </x-tabs.tab>
                    @endif

                    @stack('document_tab_end')

                    @if ($tabActive == 'recurring-templates')
                        @if (! $hideRecurringTemplates)
                        <x-tabs.tab id="recurring-templates">
                            <x-documents.index.recurring-templates :type="$type" :documents="$documents" />
                        </x-tabs.tab>
                        @endif
                    @endif

                    @stack('recurring_tab_end')
                </x-slot>
            </x-tabs>
        @else
            @if ((! $hideSearchString) && (! $hideBulkAction))
            <x-index.search
                search-string="{{ $searchStringModel }}"
                bulk-action="{{ $bulkActionClass }}"
                route="{{ $searchRoute }}"
            />
            @elseif ((! $hideSearchString) && $hideBulkAction)
            <x-index.search
                search-string="{{ $searchStringModel }}"
                route="{{ $searchRoute }}"
            />
            @elseif ($hideSearchString && (! $hideBulkAction))
            <x-index.search
                bulk-action="{{ $bulkActionClass }}"
                route="{{ $searchRoute }}"
            />
            @endif

            @stack('document_start')

            <x-documents.index.document :type="$type" :documents="$documents" />

            @stack('document_end')
        @endif
    </x-index.container>
@else
    <x-empty-page
        group="{{ $group }}"
        page="{{ $page }}"
        alias="{{ $alias }}"
        :buttons="$emptyPageButtons"
        image-empty-page="{{ $imageEmptyPage }}"
        text-empty-page="{{ $textEmptyPage }}"
        url-docs-path="{{ $urlDocsPath }}"
        check-permission-create="{{ $checkPermissionCreate }}"
    />
@endif
