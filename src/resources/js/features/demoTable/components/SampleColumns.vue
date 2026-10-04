<template>
    <div class="p-3 bg-slate-300 rounded-lg overflow-auto">
        &lt;script setup&gt; <br />
        import { useColumnBuilder } from
        "@/core/features/dataTable/composables/columnBuilder"; <br />
        &lt;/script&gt;<br />
        <br />
        &lt;template&gt;<br />
        const colHelper = useColumnBuilder&lt;testingData&gt;(); <br />
        <br />
        const dataColumns = [ <br />
        &emsp;colHelper.text("text", "Text Col"), <br />
        &emsp;colHelper.icon("icon", "FA Icon"), <br />
        &emsp;colHelper.boolean("bool", "Bool"), <br />
        &emsp;colHelper.text("size", "Formatted", { <br />
        &emsp;&emsp;formatter: (value: number) => prettyBytes(value), }), <br />
        &emsp;colHelper.date("date", "Date"), <br />
        &emsp;colHelper.phoneNumber("phone", "Phone Number"), <br />
        ]; <br />
        &lt;/template&gt;<br />
    </div>
</template>
