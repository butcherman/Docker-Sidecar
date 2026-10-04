<script setup lang="ts">
import DataTable from "@/core/features/dataResources/DataTable.vue";
import DeleteBadge from "@/core/components/badges/DeleteBadge.vue";
import EditBadge from "@/core/components/badges/EditBadge.vue";
import prettyBytes from "pretty-bytes";
import { useColumnBuilder } from "@/core/features/dataResources/composables/columnBuilder";
import { useSampleData } from "@/features/composables/sampleData";

interface testingData {
    text: string;
    icon: string;
    bool: boolean;
    size: number | bigint;
    date: string | Date;
    phone: number | string;
}

const colHelper = useColumnBuilder<testingData>();
const { sampleTableData } = useSampleData();

const dataColumns = [
    colHelper.text("text", "Text Col"),
    colHelper.icon("icon", "FA Icon"),
    colHelper.boolean("bool", "Bool"),
    colHelper.text("size", "Formatted", {
        formatter: (value: number) => prettyBytes(value),
    }),
    colHelper.date("date", "Date"),
    colHelper.phoneNumber("phone", "Phone Number"),
];
</script>

<template>
    <div>
        <DataTable
            :columns="dataColumns"
            :data="sampleTableData(50)"
            actions-slot
            paginate
            :row-class-fn="(row) => (row.bool ? 'bg-green-200/50' : '')"
            :row-click-fn="
                (e, row) => `192.168.1.251/data-table?icon=${row.icon}`
            "
        >
            <template #row.actions>
                <div class="flex gap-1">
                    <EditBadge />
                    <DeleteBadge />
                </div>
            </template>
        </DataTable>
        <div class="p-3 bg-slate-300 rounded-lg overflow-auto">
            &lt;script setup&gt; <br />
            &emsp;import DataTable from
            "@/core/features/dataTable/DataTable.vue";
            <br />
            &lt;/script&gt;<br />
            <br />
            &lt;template&gt;<br />
            &emsp;&lt;DataTable <br />
            &emsp;&emsp;:columns="dataColumns"<br />
            &emsp;&emsp;:data="sampleTableData(50)"<br />
            &emsp;&emsp;actions-slot<br />
            &emsp;&emsp;paginate<br />
            &emsp;&emsp;:row-class-fn="(row) => (row.bool ? 'bg-green-200/50' :
            '')"<br />
            &emsp;&gt;<br />

            &emsp;&emsp;&lt;template #row.actions&gt;<br />
            &emsp;&emsp;&emsp;&lt;div class="flex gap-1"&gt;<br />
            &emsp;&emsp;&emsp;&emsp;&lt;EditBadge /&gt;<br />
            &emsp;&emsp;&emsp;&emsp;&lt;DeleteBadge /&gt;<br />
            &emsp;&emsp;&emsp;&lt;/div><br />
            &emsp;&emsp;&lt;/template><br />

            &emsp;&lt;/DataTable&gt;<br />
            &lt;/template&gt;<br />
        </div>
    </div>
</template>
