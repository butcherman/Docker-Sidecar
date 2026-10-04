<script setup lang="ts">
import AddButton from "@/core/components/buttons/AddButton.vue";
import AppLayout from "@/layouts/AppLayout.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";

const referenceProperties = [
    {
        property: "title",
        type: "string",
        default: "",
        required: false,
        description:
            "Places a bordered header at the top of the card with the given text.",
    },
    {
        property: "size",
        type: "ComponentSize",
        default: "md",
        required: false,
        description: "Width of the component.",
    },
];
const slotProperties = [
    {
        name: "title",
        params: "",
        description: "Replace the default header with custom content",
    },
    {
        name: "append-title",
        params: "",
        description: "Add custom data to the right side of the title section",
    },
    {
        name: "default",
        params: "",
        description: "Card Content",
    },
    {
        name: "footer",
        params: "",
        description:
            "Place a bordered footer at the bottom of the card with custom content",
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
                Standard box with white background for grouping sections.
            </p>
        </Card>
        <ExampleComponent>
            <template #component>
                <div class="flex justify-center">
                    <Card title="I am a card" size="md">
                        <template #append-title>
                            <AddButton size="sm" text="Add Something" pill />
                        </template>
                        lorem ipsum dolor sit amet consectetur adipiscing elit
                        omnis et et accusamus pariatur vero qui aliquip dolor
                        velit et distinctio cumque libero facere ea quas
                        mollitia non deserunt sint blanditiis est quidem dolores
                        optio nostrud tempor officia elit atque aliqua corrupti
                        maxime do ducimus dolore commodo cumque et laborum est
                        <template #footer>
                            <p class="text-center">Custom Footer Content</p>
                        </template>
                    </Card>
                </div>
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import Card from "@/core/components/Card.vue" <br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;Card title="I am a card"&gt;<br />
                &emsp;&emsp;&lt;template #append-title&gt; <br />
                &emsp;&emsp;&emsp;&lt;AddButton size="sm" text="Add Something"
                pill /&gt;
                <br />
                &emsp;&emsp;&lt;/template&gt;<br />
                &emsp;&emsp;&lt;div&gt;
                <div class="ms-12">
                    lorem ipsum dolor sit amet consectetur adipiscing elit omnis
                    et et accusamus pariatur vero qui aliquip dolor velit et
                    distinctio cumque libero facere ea quas mollitia non
                    deserunt sint blanditiis est quidem dolores optio nostrud
                    tempor officia elit atque aliqua corrupti maxime do ducimus
                    dolore commodo cumque et
                </div>
                &emsp;&emsp;&lt;/div&gt; <br />
                &emsp;&emsp;&lt;template #footer&gt;<br />
                &emsp;&emsp;&emsp;&lt;p class="text-center"&gt;Custom Footer
                Content&lt;/p&gt;<br />
                &emsp;&emsp;&lt;/template&gt;<br />
                &emsp;&lt;/Card&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
        <ComponentReference
            :reference-properties="referenceProperties"
            :slot-properties="slotProperties"
        />
    </div>
</template>
