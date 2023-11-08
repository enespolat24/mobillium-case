import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, router } from "@inertiajs/react";
import DataTable from "react-data-table-component";

export default function index({ auth, posts }) {
    const handleDelete = async (row) => {
        if (window.confirm("Are you sure you want to delete this post?")) {
            try {
                const response = await router.delete(
                    route("posts.destroy", row)
                );
                if (response.status === 204) {
                    // Successful deletion, you can handle this as needed.
                    // For example, you can remove the deleted post from the data source.
                    // You may need to reload or re-fetch your posts data.
                    Inertia.reload();
                } else {
                    // Handle errors here.
                    console.error("Failed to delete post. Response:", response);
                }
            } catch (error) {
                console.error("Error deleting post:", error);
            }
        }
    };

    const columns = [
        { name: "ID", selector: "id", sortable: true },
        { name: "Title", selector: "title", sortable: true },
        { name: "slug", selector: "slug", sortable: true },
        { name: "Author", selector: "author.name", sortable: true },
        { name: "is_published", selector: "is_published", sortable: true },
        { name: "Created At", selector: "created_at", sortable: true },
        {
            name: "Actions",
            cell: (row) => (
                <div>
                    <Link
                        href={route("admin.posts.edit", row)}
                        className="text-indigo-600 hover:text-indigo-900"
                    >
                        Edit
                    </Link>
                    <button
                        onClick={() => handleDelete(row)}
                        className="text-red-600 hover:text-red-900 ml-2"
                    >
                        Delete
                    </button>
                </div>
            ),
        },
    ];

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-blue-500 leading-tight">
                    Simple admin panel
                </h2>
            }
        >
            <Head title="admin panel" />

            <DataTable
                title="Data Table"
                columns={columns}
                data={posts}
                pagination
                highlightOnHover
                responsive
            />
        </AuthenticatedLayout>
    );
}
