<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import DeferredLoader from "@/core/components/loaders/DeferredLoader.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";

const referenceProperties = [
    {
        property: "data",
        type: "string",
        default: "",
        required: true,
        description: "Name of the deferred props this component is waiting on",
    },
    {
        property: "loadingText",
        type: "string",
        default: "",
        required: false,
        description: "Text to show under the loader animation",
    },
];

const slotProperties = [
    {
        name: "loader",
        params: "",
        description: "Replace the loader animation with custom content",
    },
    {
        name: "default",
        params: "",
        description: "Content to be shown when deferred props arrive",
    },
    {
        name: "error",
        params: "",
        description: "Content to be shown when a loading error occurs",
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
                Wrapper around the Inertia JS Deferred component. Uses built in
                logic to handle errors and loading state so they do not need to
                be recreated each time.
            </p>
        </Card>
        <div class="flex gap-2">
            <ExampleComponent>
                <template #component>
                    <div>
                        <DeferredLoader
                            data="deferred-props"
                            loading-text="Loading..."
                        >
                            <div>Null Content</div>
                        </DeferredLoader>
                    </div>
                </template>
                <template #code>
                    &lt;script setup&gt; <br />
                    &emsp;import DeferredLoader from
                    "@/core/components/loaders/DeferredLoader.vue"<br />
                    &lt;/script&gt;<br />
                    <br />
                    &lt;template&gt;<br />
                    &emsp;&lt;DeferredLoader data="deferred-props"
                    loading-text="Loading..."&gt;<br />
                    &emsp;&emsp;&lt;Loaded Data /&gt;<br />
                    &emsp;&lt;Overlay /&gt;<br />
                    &lt;/template&gt;<br />
                </template>
            </ExampleComponent>
        </div>
        <ComponentReference
            :reference-properties="referenceProperties"
            :slot-properties="slotProperties"
        />
    </div>
</template>
