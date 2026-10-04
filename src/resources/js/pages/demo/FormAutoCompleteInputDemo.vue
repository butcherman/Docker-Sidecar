<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import BaseAutoCompleteInput from "@/core/forms/components/baseInputs/BaseAutoCompleteInput.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import { ref } from "vue";

const list = ["bread", "eggs", "milk", "cheese"];
const inputValue = ref("");

const referenceProperties = [
    {
        property: "name",
        type: "string",
        default: "",
        required: true,
        description: "Name of input",
    },
    {
        property: "list",
        type: "string[]",
        default: "",
        required: true,
        description: "List of items for the Auto Complete List.",
    },
    {
        property: "value",
        type: "unknown",
        default: "",
        required: true,
        description: "Value bound to input using v-bind",
    },
    {
        property: "autocomplete",
        type: "string",
        default: "",
        required: false,
        description: "Autocomplete attribute for the input",
    },
    {
        property: "disabled",
        type: "boolean",
        default: "",
        required: false,
        description: "Disable the input",
    },
    {
        property: "errorMessage",
        type: "string",
        default: "",
        required: false,
        description: "Error message when input is invalid",
    },
    {
        property: "helpMessage",
        type: "string",
        default: "",
        required: false,
        description: "Help message to show under input",
    },
    {
        property: "helpVisible",
        type: "boolean",
        default: "false",
        required: false,
        description:
            "When true, help will always be visible, not just when has focus.",
    },
    {
        property: "label",
        type: "string",
        default: "",
        required: false,
        description: "Label for the input",
    },
    {
        property: "placeholder",
        type: "string",
        default: "",
        required: false,
        description: "Placeholder Text",
    },
    {
        property: "variant",
        type: "filled | outlined | standard",
        default: "outlined",
        required: false,
        description: "Style of the input",
    },
];

const slotProperties = [
    {
        name: "prepend-input",
        params: "",
        description: "Prepends the input with bordered data",
    },
    {
        name: "append-input",
        params: "",
        description: "Appends the input with bordered data",
    },
];

const emitProperties = [
    {
        name: "focus",
        params: "",
        description: "Triggered when input gains focus",
    },
    {
        name: "blur",
        params: "",
        description: "Triggered when an input looses focus",
    },
];
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <h3 class="text-center mb-3">Auto Complete Input</h3>
            <p class="text-center">
                Auto Complete gives the user a list of possible entries, but
                still allows the user to type in their own entry that does not
                have to match the list.
            </p>
        </Card>
        <ExampleComponent>
            <template #component>
                <BaseAutoCompleteInput
                    v-model="inputValue"
                    :list="list"
                    label="Autocomplete Input"
                    name="autocomplete"
                />
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import BaseAutoCompleteInputInput from
                "@/core/forms/components/baseInputs/BaseAutoCompleteInput.vue";
                <br />
                <br />
                &emsp;const baseList = ref(["bread", "eggs", "milk",
                "cheese"]);<br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;BaseAutoCompleteInput<br />
                &emsp;&emsp;v-model="textValue"<br />
                &emsp;&emsp;name="autocomplete"<br />
                &emsp;&emsp;label="Autocomplete Input"<br />
                &emsp;&emsp;:list="baseList"<br />
                &emsp;&lt;/BaseAutoCompleteInput&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
        <ComponentReference
            :reference-properties="referenceProperties"
            :slot-properties="slotProperties"
            :emit-properties="emitProperties"
        />
    </div>
</template>
