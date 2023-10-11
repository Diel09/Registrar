
<script setup>
import PerfectScrollbar from '@/Components/PerfectScrollbar.vue'
import SidebarLink from '@/Components/Sidebar/SidebarLink.vue'
import { Request } from '@/Components/Icons/outline'
import { Requests } from '@/Components/Icons/outline'
import SidebarCollapsible from '@/Components/Sidebar/SidebarCollapsible.vue'
import SidebarCollapsibleItem from '@/Components/Sidebar/SidebarCollapsibleItem.vue'
import { TemplateIcon } from '@heroicons/vue/outline'
</script>

<template>
    <PerfectScrollbar
        tagname="nav"
        aria-label="main"
        class="relative flex flex-col flex-1 max-h-full gap-4 px-3"
    >
    
    <SidebarLink
            title="Dashboard"
            :href="route('request.form')"
            :active="route().current('request.form')"
        >
            <template #icon>
                <Request
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>
        
        <SidebarLink
            title="To be Approve"
            :href="route('request.form')"
            :active="route().current('request.form')"
        >
            <template #icon>
                <Request
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <SidebarLink
            title="Requests"
            :href="route('requests.form')"
            :active="route().current('requests.form')"
        >
            <template #icon>
                <Requests
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>

        <SidebarLink
            title="Documents"
            :href="route('documents')"
            :active="route().current('documents')"
        >
            <template #icon>
                <Request
                    class="flex-shrink-0 w-6 h-6"
                    aria-hidden="true"
                />
            </template>
        </SidebarLink>
    </PerfectScrollbar>
</template>
