# Origin Project
course 607 from shiyanlou.com
# Directory Structure
```
Labframe
├── app                    # app root
│   └── home              # module root (home)
│       ├── controller    # save controller files handle actions
│       ├── model         # save model files, handle model functions
│       └── view          # save the views ,template file .etc
├── config                 # framework configuration
│   └── config.php        # framework configs
├── index.php              # entry file
├── ReadME.md              # project description
├── runtime                # store the file created in runtime
│   ├── cache             # cache
│   ├── compile           # the file compiled
│   └── log               # records
└── sys
    ├── core               # framework core
    └── start.php          # framework launcher
```