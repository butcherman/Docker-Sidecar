<template>
    <div class="flex flex-col gap-1">
        <table>
            <tbody>
                <tr class="border-b border-b-slate-300">
                    <td class="p-2 border-e border-e-slate-300">icon</td>
                    <td class="p-2">Icon to display next to the Column name</td>
                </tr>
                <tr class="border-b border-b-slate-300">
                    <td class="p-2 border-e border-e-slate-300">filterable</td>
                    <td class="p-2">If the column is allowed to be filtered</td>
                </tr>
                <tr class="border-b border-b-slate-300">
                    <td class="p-2 border-e border-e-slate-300">
                        filterSelect
                    </td>
                    <td class="p-2">
                        Drop down list of all available values for that column.
                        Useful when the column value is restricted to only a few
                        possible values.
                    </td>
                </tr>
                <tr class="border-b border-b-slate-300">
                    <td class="p-2 border-e border-e-slate-300">sort</td>
                    <td class="p-2">Allows the row to be sorted by values</td>
                </tr>
                <tr class="border-b border-b-slate-300">
                    <td class="p-2 border-e border-e-slate-300">align</td>
                    <td class="p-2">Verticle alignment of the cell.</td>
                </tr>
                <tr class="border-b border-b-slate-300">
                    <td class="p-2 border-e border-e-slate-300">cell</td>
                    <td class="p-2">
                        Callback to load custom component into cell.
                    </td>
                </tr>
                <tr>
                    <td class="p-2 border-e border-e-slate-300">formatter</td>
                    <td class="p-2">
                        Callback function to reformat the value.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
