<script setup lang="ts">
import DataTable from "@/core/features/dataResources/DataTable.vue";
import { useReferenceHelper } from "@/features/composables/referenceHelper";

const { getPropColumns, getSlotColumns } = useReferenceHelper();

const referenceProperties = [
    {
        property: "columns",
        type: "DataTableColumn<TRow, any>",
        default: "null",
        required: true,
        description:
            "Column data - use Column Builder to create columns matching proper format",
    },
    {
        property: "data",
        type: "TRow[]",
        default: "null",
        required: true,
        description: "Data to be displayed in the table",
    },
    {
        property: "actionSlot",
        type: "boolean",
        default: "false",
        required: false,
        description:
            "When enabled, an additional slot becomes available for row actions",
    },
    {
        property: "allowRowClick",
        type: "boolean",
        default: "false",
        required: false,
        description:
            "When enabled, row cursor is a pointer and a row click event will be emitted",
    },
    {
        property: "compact",
        type: "boolean",
        default: "false",
        required: false,
        description: "Removes all extra padding and margins to compress data",
    },
    {
        property: "stripped",
        type: "boolean",
        default: "false",
        required: false,
        description: "Alternates row background colors",
    },
    {
        property: "gridLines",
        type: "boolean",
        default: "false",
        required: false,
        description: "Places borders around the table rows and columns",
    },
    {
        property: "noResultsText",
        type: "string",
        default: "null",
        required: false,
        description: "Text to display when no data rows are available",
    },
    {
        property: "paginate",
        type: "boolean",
        default: "false",
        required: false,
        description: "Determines if data should be chunked and paginated",
    },
    {
        property: "rowClassFn",
        type: "(row: TRow) => string | false",
        default: "undefined",
        required: false,
        description: "Function to run on each row to set its background color",
    },
    {
        property: "rowLinkFn",
        type: "(event: MouseEvent, row: TRow) => void",
        default: "undefined",
        required: false,
        description: "Function to run on each row to set its href destination",
    },
];

const slotProperties = [
    {
        name: "header[dataField]",
        params: "cellMetaData",
        description: "Replace the cell Header with custom data",
    },
    {
        name: "header.actions",
        params: "",
        description:
            "Custom data for the action header slot (blank by default)",
    },
    {
        name: "noResults",
        params: "",
        description: "Shows when the data is empty",
    },
    {
        name: "row[dataField]",
        params: "RowData",
        description: "Replace data in the column for all rows",
    },
    {
        name: "row.actions",
        params: "RowData",
        description: "Action cell for all rows",
    },
    {
        name: "footer",
        params: "",
        description: "Replace row footer",
    },
];

const emitReferences = [
    {
        name: "rowClick",
        params: "RowData",
        description:
            "Emited when a row is clicked.  Only available when rowLinkFn or allowRowClick props are assigned",
    },
];
</script>

<template>
    <div>
        <h4>Props</h4>
        <DataTable :columns="getPropColumns()" :data="referenceProperties" />
        <h4>Slots</h4>
        <DataTable :columns="getSlotColumns()" :data="slotProperties" />
        <h4>Emits</h4>
        <DataTable :columns="getSlotColumns()" :data="emitReferences" />
    </div>
</template>
