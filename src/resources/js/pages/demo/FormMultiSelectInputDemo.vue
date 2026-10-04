<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import BaseMultiSelectInput from "@/core/forms/components/baseInputs/BaseMultiSelectInput.vue";
import BaseMultiSelectGroupInput from "@/core/forms/components/baseInputs/BaseMultiSelectGroupInput.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import { ref } from "vue";
import { useSampleData } from "@/features/composables/sampleData";

const { sampleList } = useSampleData();

const basicList = ref(["eggs", "milk", "cheese", "bread", "cookies", "salad"]);
const groupedList = ref([
    {
        groupName: "admins",
        data: sampleList(5),
    },
    {
        groupName: "executives",
        data: sampleList(5),
    },
    {
        groupName: "users",
        data: sampleList(5),
    },
]);
const basicInputValue = ref([]);
const advancedInputValue = ref([]);
const groupedInputValue = ref([]);

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
        type: "TGroup[] | TOption[] | string[]",
        default: "",
        required: true,
        description: "List of options for the multiselect list",
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
        property: "groupTextField",
        type: "keyof TGroup",
        default: "",
        required: false,
        description:
            "Identifies the object field that will be used as the Group Name.  Used only with MultiSelectGroupInput",
    },
    {
        property: "groupListField",
        type: "keyof TGroup",
        default: "",
        required: false,
        description:
            "Identifies the list field that will be used to populate the list.  Used only with MultiSelectGroupInput",
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
    {
        property: "variant",
        type: "filled | outlined | standard",
        default: "outlined",
        required: false,
        description: "Style of the input",
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
            <h3 class="text-center mb-3">Multiselect Input</h3>
            <p class="text-center">
                Allows users to select multiple options from a drop down list.
            </p>
        </Card>
        <ExampleComponent title="Basic MultiSelect">
            <template #component>
                <BaseMultiSelectInput
                    v-model="basicInputValue"
                    name="multiselect"
                    label="Multi-Select"
                    :list="basicList"
                />
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import BaseMultiSelectInput from
                "@/core/forms/components/baseInputs/BaseMultiSelectInput.vue";
                <br />
                <br />
                &emsp;const basicInputValue = ["eggs", "milk", "cheese",
                "bread", "cookies", "salad"]<br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;BaseMultiSelectInput<br />
                &emsp;&emsp;v-model="basicInputValue"<br />
                &emsp;&emsp;name="multiselect"<br />
                &emsp;&emsp;label="Multi-Select"<br />
                &emsp;&emsp;:list="simpleList"<br />
                &emsp;/&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
        <ExampleComponent title="Advanced Dataset MultiSelect">
            <template #component>
                <BaseMultiSelectInput
                    v-model="advancedInputValue"
                    name="multiselect"
                    label="Multi-Select"
                    :list="sampleList(5)"
                    text-field="name"
                    value-field="username"
                />
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import BaseMultiSelectInput from
                "@/core/forms/components/baseInputs/BaseMultiSelectInput.vue";
                <br />
                <br />
                &emsp;const advancedInputValue = [<br />
                &emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;name: 'BillyBob',<br />
                &emsp;&emsp;&emsp;username: 'bbob'<br />
                &emsp;&emsp;},<br />
                &emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;name: 'John Doe',<br />
                &emsp;&emsp;&emsp;username: 'jdoe',<br />
                &emsp;&emsp;},<br />
                &emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;name: 'Ricky Bobby',<br />
                &emsp;&emsp;&emsp;username: 'rbobby',<br />
                &emsp;&emsp;} <br />
                &emsp;]<br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;BaseMultiSelectInput<br />
                &emsp;&emsp;v-model="advancedInputValue"<br />
                &emsp;&emsp;name="multiselect"<br />
                &emsp;&emsp;label="Multi-Select"<br />
                &emsp;&emsp;:list="simpleList"<br />
                &emsp;&emsp;text-field="name"<br />
                &emsp;&emsp;value-field="username"<br />
                &emsp;/&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
        <ExampleComponent title="Grouped Dataset MultiSelect">
            <template #component>
                <BaseMultiSelectGroupInput
                    v-model="groupedInputValue"
                    name="multiselect"
                    label="Multi-Select"
                    :list="groupedList"
                    text-field="name"
                    value-field="username"
                    group-text-field="groupName"
                    group-list-field="data"
                />
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import BaseMultiSelectInput from
                "@/core/forms/components/baseInputs/BaseMultiSelectInput.vue";
                <br />
                <br />
                &emsp;const groupedList = ref([<br />
                &emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;groupName: "admins",<br />
                &emsp;&emsp;&emsp;data: [<br />
                &emsp;&emsp;&emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;&emsp;&emsp;name: "Dianne Veum",<br />
                &emsp;&emsp;&emsp;&emsp;&emsp;username: "dveum",<br />
                &emsp;&emsp;&emsp;&emsp;},<br />
                &emsp;&emsp;&emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;&emsp;&emsp;name: "Neva Donnelly",<br />
                &emsp;&emsp;&emsp;&emsp;&emsp;username: "ndonnelly",<br />
                &emsp;&emsp;&emsp;&emsp;},<br />
                &emsp;&emsp;&emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;&emsp;&emsp;name: "Conner Barrows",<br />
                &emsp;&emsp;&emsp;&emsp;&emsp;username: "cbarrows",<br />
                &emsp;&emsp;&emsp;&emsp;},<br />
                &emsp;&emsp;&emsp;]<br />
                &emsp;&emsp;},<br />
                &emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;groupName: "executives",<br />
                &emsp;&emsp;&emsp;data: [<br />
                &emsp;&emsp;&emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;&emsp;&emsp;name: "Vera VonRueden",<br />
                &emsp;&emsp;&emsp;&emsp;&emsp;username: "vvonrueden",<br />
                &emsp;&emsp;&emsp;&emsp;},<br />
                &emsp;&emsp;&emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;&emsp;&emsp;name: "Joan Durgan",<br />
                &emsp;&emsp;&emsp;&emsp;&emsp;username: "jdurgan",<br />
                &emsp;&emsp;&emsp;&emsp;},<br />
                &emsp;&emsp;&emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;&emsp;&emsp;name: "Gina Ritchie",<br />
                &emsp;&emsp;&emsp;&emsp;&emsp;username: "gritchie",<br />
                &emsp;&emsp;&emsp;&emsp;},<br />
                &emsp;&emsp;&emsp;]<br />
                &emsp;&emsp;},<br />
                &emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;groupName: "users",<br />
                &emsp;&emsp;&emsp;data: [<br />
                &emsp;&emsp;&emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;&emsp;&emsp;name: "Josh Bernhard",<br />
                &emsp;&emsp;&emsp;&emsp;&emsp;username: "jbernhard",<br />
                &emsp;&emsp;&emsp;&emsp;},<br />
                &emsp;&emsp;&emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;&emsp;&emsp;name: "Levi Labadie",<br />
                &emsp;&emsp;&emsp;&emsp;&emsp;username: "llabadie",<br />
                &emsp;&emsp;&emsp;&emsp;},<br />
                &emsp;&emsp;&emsp;&emsp;{<br />
                &emsp;&emsp;&emsp;&emsp;&emsp;name: "Carmen Bernhard",<br />
                &emsp;&emsp;&emsp;&emsp;&emsp;username: "cbernhard",<br />
                &emsp;&emsp;&emsp;&emsp;},<br />
                &emsp;&emsp;&emsp;]<br />
                &emsp;&emsp;},<br />
                &emsp;]);<br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;BaseMultiSelectInput<br />
                &emsp;&emsp;v-model="groupedInputValue"<br />
                &emsp;&emsp;name="multiselect"<br />
                &emsp;&emsp;label="Multi-Select"<br />
                &emsp;&emsp;:list="groupedList"<br />
                &emsp;&emsp;text-field="name"<br />
                &emsp;&emsp;value-field="username"<br />
                &emsp;&emsp;group-text-field="groupName"<br />
                &emsp;&emsp;group-list-field="data"<br />
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
