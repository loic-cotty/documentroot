<?php

namespace App\Controller\Admin;

use App\Entity\Favorite;
use App\Entity\Image;
use App\Entity\Post;
use App\Entity\Tag;
use App\Repository\FavoriteRepository;
use App\Repository\ImageRepository;
use App\Repository\PostRepository;
use App\Repository\TagRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @var PostRepository
     */
    private PostRepository $postRepository;

    /**
     * @var TagRepository
     */
    private TagRepository $tagRepository;

    /**
     * @var FavoriteRepository
     */
    private FavoriteRepository $favoriteRepository;

    /**
     * @var ImageRepository
     */
    private ImageRepository $imageRepository;

    /**
     * @param PostRepository $postRepository
     * @param TagRepository $tagRepository
     * @param FavoriteRepository $favoriteRepository
     * @param ImageRepository $imageRepository
     */
    public function __construct(
        PostRepository $postRepository,
        TagRepository $tagRepository,
        FavoriteRepository $favoriteRepository,
        ImageRepository $imageRepository
    )
    {
        $this->postRepository = $postRepository;
        $this->tagRepository = $tagRepository;
        $this->favoriteRepository = $favoriteRepository;
        $this->imageRepository = $imageRepository;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/welcome.html.twig', [
            'posts' => $this->postRepository->findAll(),
            'favorites' => $this->favoriteRepository->findAll(),
            'tags' => $this->tagRepository->findAll(),
            'images' => $this->imageRepository->findAll(),
        ]);

    }

    /**
     * @return Dashboard
     */
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('ACME Corp.')

            // you can include HTML contents too (e.g. to link to an image)
            ->setTitle('<i class="fab fa-evernote"></i> DocumentRoot')

            // the path defined in this method is passed to the Twig asset() function
            ->setFaviconPath('favicon.svg')

            // the domain used by default is 'messages'
            ->setTranslationDomain('my-custom-domain')

            // there's no need to define the "text direction" explicitly because
            // its default value is inferred dynamically from the user locale
            ->setTextDirection('ltr')
            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            ->renderContentMaximized()


            // set this option if you prefer the sidebar (which contains the main menu)
            // to be displayed as a narrow column instead of the default expanded design
            //->renderSidebarMinimized()

            // by default, all backend URLs include a signature hash. If a user changes any
            // query parameter (to "hack" the backend) the signature won't match and EasyAdmin
            // triggers an error. If this causes any issue in your backend, call this method
            // to disable this feature and remove all URL signature checks
            ->disableUrlSignatures()

            // by default, all backend URLs are generated as absolute URLs. If you
            // need to generate relative URLs instead, call this method
            ->generateRelativeUrls();
    }

    /**
     * @return iterable
     */
    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'index');
        yield MenuItem::section('Blog');
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-pen');
        yield MenuItem::linkToCrud('All Posts', 'fa fa-file-text', Post::class);
        yield MenuItem::linkToCrud('All Tags', 'fas fa-tags', Tag::class);
        yield MenuItem::linkToCrud('All Favorites', 'fas fa-star', Favorite::class);
        yield MenuItem::linkToCrud('All Images', 'fas fa-image', Image::class);
    }
}
