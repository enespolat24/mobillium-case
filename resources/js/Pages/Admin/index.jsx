import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";

export default function index({ auth, posts }) {
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

            <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4 p-8">
                {posts.data.map((post, key) => (
                    <Link href={route("admin.posts.edit", post.slug)}>
                        <div
                            key={key}
                            className="bg-white overflow-hidden shadow-sm rounded-lg"
                        >
                            <div className="px-6 py-4">
                                <div className="font-semibold text-xl mb-2">
                                    {post.title}
                                </div>
                                <p className="text-gray-700 text-base">
                                    {post.content}
                                </p>
                            </div>
                        </div>
                    </Link>
                ))}
            </div>
            <div className="mt-4 text-center">
                {posts.links.map((link, key) => (
                    <Link
                        key={key}
                        href={link.url}
                        className={`text-xs mr-2 px-2 py-1 rounded-md ${
                            link.active
                                ? "bg-blue-500 text-white"
                                : "bg-gray-200"
                        }`}
                        dangerouslySetInnerHTML={{ __html: link.label }}
                    ></Link>
                ))}
            </div>
        </AuthenticatedLayout>
    );
}
