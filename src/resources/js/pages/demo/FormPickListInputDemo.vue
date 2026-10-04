<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import BasePickListInput from "@/core/forms/components/baseInputs/BasePickListInput.vue";
import { ref } from "vue";

const inputValue = ref([]);
const advancedValue = ref([]);
const inputList = ["Option 1", "Option 2", "Option 3", "Option 4", "Option 5"];
const advancedList = [
    {
        text: "Option 1",
        value: "opt1",
    },
    {
        text: "Option 2",
        value: "opt2",
    },
    {
        text: "Option 3",
        value: "opt3",
    },
    {
        text: "Option 4",
        value: "opt4",
    },
];

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
        type: "TOption[] | string[]",
        default: "",
        required: true,
        description: "List of options for the multiselect list",
    },
    {
        property: "value",
        type: "string[]",
        default: "",
        required: true,
        description: "Value bound to input using v-bind",
    },
    {
        property: "disabled",
        type: "boolean",
        default: "false",
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
        property: "selectSize",
        type: "number",
        default: "10",
        required: false,
        description: "Size (height) of the pick list input",
    },
    {
        property: "textField",
        type: "keyof TOption",
        default: "",
        required: false,
        description:
            "Object field that identifies what text to display in the dropdown list",
    },
    {
        property: "valueField",
        type: "keyof TOption",
        default: "",
        required: false,
        description:
            "Object field that identifies the value of the item in the dropdown list.",
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
            <h3 class="text-center mb-3">Pick List Input</h3>
            <p class="text-center">
                Move selected items from one side of the available list, to the
                selected list
            </p>
        </Card>
        <ExampleComponent title="Basic Example">
            <template #component>
                <BasePickListInput
                    v-model="inputValue"
                    label="Pick List Example"
                    name="pick_list"
                    :list="inputList"
                />
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import BasePickListInput from
                "@/core/forms/components/baseInputs/BasePickListInput.vue";
                <br />
                <br />
                &emsp;const inputList = ["Option 1", "Option 2", "Option 3",
                "Option 4", "Option 5"];<br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;BasePickListInput<br />
                &emsp;&emsp;v-model="inputValue"<br />
                &emsp;&emsp;name="pick_list"<br />
                &emsp;&emsp;label="Pick List Example"<br />
                &emsp;&emsp;:list="inputList"<br />
                &emsp;/&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
        <ExampleComponent title="Object List Example">
            <template #component>
                <BasePickListInput
                    v-model="advancedValue"
                    name="pick_list"
                    text-field="text"
                    value-field="value"
                    :list="advancedList"
                />
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import BasePickListInput from
                "@/core/forms/components/baseInputs/BasePickListInput.vue";
                <br />
                <br />
                &emsp;const advancedList = [<br />
                &emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;text: "Option 1",<br />
                &emsp;&emsp;&emsp;value: "opt1",<br />
                &emsp;&emsp;},<br />
                &emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;text: "Option 2",<br />
                &emsp;&emsp;&emsp;value: "opt2",<br />
                &emsp;&emsp;},<br />
                &emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;text: "Option 3",<br />
                &emsp;&emsp;&emsp;value: "opt3",<br />
                &emsp;&emsp;},<br />
                &emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;text: "Option 4",<br />
                &emsp;&emsp;&emsp;value: "opt4",<br />
                &emsp;&emsp;},<br />
                &emsp;];<br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;BasePickListInput<br />
                &emsp;&emsp;v-model="inputValue"<br />
                &emsp;&emsp;name="pick_list"<br />
                &emsp;&emsp;label="Pick List Example"<br />
                &emsp;&emsp;:list="advancedList"<br />
                &emsp;/&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
        <ComponentReference
            :reference-properties="referenceProperties"
            :emit-properties="emitProperties"
        />
    </div>
</template>
