<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import BaseTextInput from "@/core/forms/components/baseInputs/BaseTextInput.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import { reactive } from "vue";

const referenceProperties = [
    {
        property: "name",
        type: "string",
        default: "",
        required: true,
        description: "Name of input",
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

const formValues = reactive({
    basicText: "",
    slotsText: "",
});
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <h3 class="text-center mb-3">Text Input</h3>
            <p class="text-center">Basic Text Input</p>
        </Card>
        <ExampleComponent title="Basic Example">
            <template #component>
                <BaseTextInput
                    v-model="formValues.basicText"
                    name="text_input"
                    label="Outlined Input"
                    placeholder="Test Input"
                    error-message="This is an error message"
                    help-message="This is a help message"
                    variant="outlined"
                />
                <BaseTextInput
                    v-model="formValues.basicText"
                    name="text_input"
                    label="Filled Input"
                    placeholder="Test Input"
                    error-message="This is an error message"
                    help-message="This is a help message"
                    variant="filled"
                />
                <BaseTextInput
                    v-model="formValues.basicText"
                    name="text_input"
                    label="Standard Input"
                    placeholder="Test Input"
                    error-message="This is an error message"
                    help-message="This is a help message"
                    variant="standard"
                />
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import BaseTextInput from
                "@/core/forms/components/baseInputs/BaseTextInput.vue";
                <br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;BaseTextInput<br />
                &emsp;&emsp;v-model="textValue"<br />
                &emsp;&emsp;name="text_input"<br />
                &emsp;&emsp;label="Text Input"<br />
                &emsp;&emsp;placeholder="Test Input"<br />
                &emsp;&emsp;error-message="This is an error message"<br />
                &emsp;&emsp;help-message="This is a help message"<br />
                &emsp;&emsp;variant="outlined"<br />
                &emsp;/BaseTextInput&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>

        <ExampleComponent title="Slots Example">
            <template #component>
                <BaseTextInput
                    v-model="formValues.slotsText"
                    name="text_input"
                    label="Text Input"
                    placeholder="Test Input"
                >
                    <template #prepend-input>https://</template>
                    <template #append-input>
                        <fa-icon icon="book-open-reader" />
                    </template>
                </BaseTextInput>
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import BaseTextInput from
                "@/core/forms/components/baseInputs/BaseTextInput.vue";
                <br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;BaseTextInput<br />
                &emsp;&emsp;v-model="textValue"<br />
                &emsp;&emsp;name="text_input"<br />
                &emsp;&emsp;label="Text Input"<br />
                &emsp;&emsp;placeholder="Test Input"<br />
                &emsp;&emsp;error-message="This is an error message"<br />
                &emsp;&emsp;help-message="This is a help message"<br />
                &emsp;&gt; <br />
                &emsp;&emsp;&lt;template
                #prepend-input&gt;https://&lt;template&gt;<br />
                &emsp;&emsp;&lt;template #append-input&gt;<br />
                &emsp;&emsp;&emsp;&lt;fa-icon icon="book-open-reader" /&gt;<br />
                &emsp;&emsp;&lt;/template&gt;<br />
                &emsp;&lt;/BaseTextInput&gt;<br />
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
