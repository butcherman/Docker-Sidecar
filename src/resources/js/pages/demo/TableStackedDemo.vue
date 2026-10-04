<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import TableStacked from "@/core/features/dataResources/TableStacked.vue";

const sampleData = {
    first_name: "Billy",
    last_name: "Bob",
    email_address: "billy.bob@noem.com",
    is_redneck: true,
};

const referenceProperties = [
    {
        property: "data",
        type: "TData",
        default: "",
        required: true,
        description: "Data for the table",
    },
    {
        property: "bordered",
        type: "boolean",
        default: "false",
        required: false,
        description: "Put borders around all data in the table.",
    },
    {
        property: "only",
        type: "string[]",
        default: "",
        required: false,
        description:
            "Array of data keys that will be inluded in the table.  All other keys will be ignored",
    },
    {
        property: "skip",
        type: "string[]",
        default: "",
        required: false,
        description: "Array of data keys that will be ignored in the table.",
    },
];
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <p class="text-center">
                Quick and simple table component for displaying information in a
                Key: Value format.
            </p>
        </Card>
        <div class="flex justify-center gap-2">
            <Card title="Sample Data" class="flex-1">
                <div class="p-3 bg-slate-300 rounded-lg overflow-auto">
                    const sampleData = { <br />
                    &emsp;first_name: "Billy", <br />
                    &emsp;last_name: "Bob", <br />
                    &emsp;email_address: "billy.bob@noem.com", <br />
                    &emsp;is_redneck: true,<br />
                    };
                </div>
            </Card>
            <ExampleComponent show>
                <div class="flex justify-center mb-2">
                    <TableStacked :data="sampleData" />
                </div>
                <div class="p-3 bg-slate-300 rounded-lg overflow-auto">
                    &lt;script setup&gt; <br />
                    &emsp;import TableStacked from
                    "@/core/features/dataTable/TableStacked.vue" <br />
                    &lt;/script&gt;<br />
                    <br />
                    &lt;template&gt;<br />
                    &emsp;&lt;TableStacked :data="sampleData" /&gt;<br />
                    &lt;/template&gt;<br />
                </div>
            </ExampleComponent>
        </div>
        <ComponentReference :reference-properties="referenceProperties" />
    </div>
</template>
