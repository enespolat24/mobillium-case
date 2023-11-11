import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";

export default function AuthorIndex({ auth, posts }) {
    console.log("data bunlar", posts);
    return (
        <>
            <AuthenticatedLayout
                user={auth.user}
                header={
                    <h2 className="font-semibold text-xl text-blue-500 leading-tight">
                        Simple author panel
                    </h2>
                }
            >
                <Head title="Author panel" />

                {/* <DataTable
                title="Data Table"
                columns={columns}
                data={posts}
                pagination
                highlightOnHover
                responsive
            /> */}
            </AuthenticatedLayout>
        </>
    );
}
